<?php

	namespace jb_itop_extensions\switch_env;
	
	// iTop internals
	use AbstractPageUIBlockExtension;
	use Combodo\iTop\Application\UI\Base\Component\Html\Html;
	use MetaModel;
	
	/**
	 * Class SwitchEnvControl. Adds control to iTop backend top
	 */
	class SwitchEnvControl extends AbstractPageUIBlockExtension {
	
			
		/**
		 * @inheritDoc
		 */
		public function GetBannerBlock() {
			
			$sHTML =
				<<<HTML

					<div style="text-align: center; width: 100%;">
						<select id="switch_env" onchange="javascript:let sEnv = $('#switch_env').val(); let sUrl = window.location.href.replace(/(&|\?)switch_env=.*?(?=&|$)/, ''); if(sUrl.includes('?') == false){ window.location.href = sUrl + '?switch_env=' + sEnv;} else { window.location.href = sUrl.replace('?', '?&switch_env=' + sEnv); }">
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
	
			return new Html($sHTML);
		
		}

		
}
	
