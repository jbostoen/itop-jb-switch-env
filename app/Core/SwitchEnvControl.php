<?php

	namespace jb_itop_extensions\switch_env;
	
	// iTop internals
	use \AbstractPageUIExtension;
	use \iTopWebPage;
	use \MetaModel;
	
	/**
	 * Class SwitchEnvControl. Adds control to iTop backend top
	 */
	class SwitchEnvControl extends AbstractPageUIExtension {
	
			
		/**
		 * @inheritDoc
		 */
		public function GetBannerHtml(iTopWebPage $oPage) {
			
			$sHTML =
<<<HTML
	
				<div style="text-align: center; width: 100%;">
					<select id="switch_env" onchange="javascript:var sEnv = $('#switch_env').val(); var sUrl = window.location.href; if(sUrl.includes('?') == false){ window.location.href = sUrl + '?switch_env=' + sEnv;} else { sUrl = sUrl.replace(/(&|\?)switch_env=.*?(?=&|$)/, ''); window.location.href = sUrl + '&switch_env=' + sEnv; }">
HTML;
			
			$aEnvironments = glob(APPCONF.'/*', GLOB_ONLYDIR);
			$sCurrentEnv = MetaModel::GetEnvironment();
			
			foreach($aEnvironments as $sEnv) {
				
				$sEnv = basename($sEnv);
				$sSelected = ($sEnv == $sCurrentEnv ? 'selected' : '');
				
				$sHTML .=
<<<HTML
						<option value="{$sEnv}" {$sSelected}>{$sEnv}</option>
HTML;
			}
			

			$sHTML .=
<<<HTML
					</select>
				</div>
HTML;
		
			return $sHTML;
			
		}

	
	}