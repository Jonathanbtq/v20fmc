<?php
/* Copyright (C) 2023		Laurent Destailleur			<eldy@users.sourceforge.net>
 * Copyright (C) 2024		SuperAdmin
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * \file    fastmodulecheck/class/actions_fastmodulecheck.class.php
 * \ingroup fastmodulecheck
 * \brief   Example hook overload.
 *
 * TODO: Write detailed description here.
 */

require_once DOL_DOCUMENT_ROOT.'/core/class/commonhookactions.class.php';

/**
 * Class ActionsFastmodulecheck
 */
class ActionsFastmodulecheck extends CommonHookActions
{
	/**
	 * @var DoliDB Database handler.
	 */
	public $db;

	/**
	 * @var string Error code (or message)
	 */
	public $error = '';

	/**
	 * @var string[] Errors
	 */
	public $errors = array();


	/**
	 * @var mixed[] Hook results. Propagated to $hookmanager->resArray for later reuse
	 */
	public $results = array();

	/**
	 * @var ?string String displayed by executeHook() immediately after return
	 */
	public $resprints;

	/**
	 * @var int		Priority of hook (50 is used if value is not defined)
	 */
	public $priority;


	/**
	 * Constructor
	 *
	 *  @param	DoliDB	$db      Database handler
	 */
	public function __construct($db)
	{
		$this->db = $db;
	}


	/**
	 * Execute action
	 *
	 * @param	array<string,mixed>	$parameters	Array of parameters
	 * @param	CommonObject		$object		The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param	string				$action		'add', 'update', 'view'
	 * @return	int								Return integer <0 if KO,
	 *                           				=0 if OK but we want to process standard actions too,
	 *											>0 if OK and we want to replace standard actions.
	 */
	public function getNomUrl($parameters, &$object, &$action)
	{
		global $db, $langs, $conf, $user;
		$this->resprints = '';
		return 0;
	}

	/**
	 * Overload the doActions function : replacing the parent's function with the one below
	 *
	 * @param	array<string,mixed>	$parameters		Hook metadata (context, etc...)
	 * @param	CommonObject		$object			The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param	?string				$action			Current action (if set). Generally create or edit or null
	 * @param	HookManager			$hookmanager	Hook manager propagated to allow calling another hook
	 * @return	int									Return integer < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function doActions($parameters, &$object, &$action, $hookmanager)
	{
		global $conf, $user, $langs;

		$error = 0; // Error counter

		/* print_r($parameters); print_r($object); echo "action: " . $action; */
		// @phan-suppress-next-line PhanPluginEmptyStatementIf
		if (in_array($parameters['currentcontext'], array('somecontext1', 'somecontext2'))) {	    // do something only for the context 'somecontext1' or 'somecontext2'
			// Do what you want here...
			// You can for example load and use call global vars like $fieldstosearchall to overwrite them, or update the database depending on $action and GETPOST values.
		}

		if (!$error) {
			$this->results = array('myreturn' => 999);
			$this->resprints = 'A text to show';
			return 0; // or return 1 to replace standard code
		} else {
			$this->errors[] = 'Error message';
			return -1;
		}
	}


	/**
	 * Overload the doMassActions function : replacing the parent's function with the one below
	 *
	 * @param	array<string,mixed>	$parameters		Hook metadata (context, etc...)
	 * @param	CommonObject		$object			The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param	?string				$action			Current action (if set). Generally create or edit or null
	 * @param	HookManager			$hookmanager	Hook manager propagated to allow calling another hook
	 * @return	int									Return integer < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function doMassActions($parameters, &$object, &$action, $hookmanager)
	{
		global $conf, $user, $langs;

		$error = 0; // Error counter

		/* print_r($parameters); print_r($object); echo "action: " . $action; */
		if (in_array($parameters['currentcontext'], array('somecontext1', 'somecontext2'))) {		// do something only for the context 'somecontext1' or 'somecontext2'
			// @phan-suppress-next-line PhanPluginEmptyStatementForeachLoop
			foreach ($parameters['toselect'] as $objectid) {
				// Do action on each object id
			}
		}

		if (!$error) {
			$this->results = array('myreturn' => 999);
			$this->resprints = 'A text to show';
			return 0; // or return 1 to replace standard code
		} else {
			$this->errors[] = 'Error message';
			return -1;
		}
	}


	/**
	 * Overload the addMoreMassActions function : replacing the parent's function with the one below
	 *
	 * @param	array<string,mixed>	$parameters     Hook metadata (context, etc...)
	 * @param	CommonObject		$object         The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param	?string	$action						Current action (if set). Generally create or edit or null
	 * @param	HookManager	$hookmanager			Hook manager propagated to allow calling another hook
	 * @return	int									Return integer < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function addMoreMassActions($parameters, &$object, &$action, $hookmanager)
	{
		global $conf, $user, $langs;

		$error = 0; // Error counter
		$disabled = 1;

		/* print_r($parameters); print_r($object); echo "action: " . $action; */
		if (in_array($parameters['currentcontext'], array('somecontext1', 'somecontext2'))) {		// do something only for the context 'somecontext1' or 'somecontext2'
			$this->resprints = '<option value="0"'.($disabled ? ' disabled="disabled"' : '').'>'.$langs->trans("FastmodulecheckMassAction").'</option>';
		}

		if (!$error) {
			return 0; // or return 1 to replace standard code
		} else {
			$this->errors[] = 'Error message';
			return -1;
		}
	}



	/**
	 * Execute action before PDF (document) creation
	 *
	 * @param	array<string,mixed>	$parameters	Array of parameters
	 * @param	CommonObject		$object		Object output on PDF
	 * @param	string				$action		'add', 'update', 'view'
	 * @return	int								Return integer <0 if KO,
	 *											=0 if OK but we want to process standard actions too,
	 *											>0 if OK and we want to replace standard actions.
	 */
	public function beforePDFCreation($parameters, &$object, &$action)
	{
		global $conf, $user, $langs;
		global $hookmanager;

		$outputlangs = $langs;

		$ret = 0;
		$deltemp = array();
		dol_syslog(get_class($this).'::executeHooks action='.$action);

		/* print_r($parameters); print_r($object); echo "action: " . $action; */
		// @phan-suppress-next-line PhanPluginEmptyStatementIf
		if (in_array($parameters['currentcontext'], array('somecontext1', 'somecontext2'))) {		// do something only for the context 'somecontext1' or 'somecontext2'
		}

		return $ret;
	}

	/**
	 * Execute action after PDF (document) creation
	 *
	 * @param	array<string,mixed>	$parameters	Array of parameters
	 * @param	CommonDocGenerator	$pdfhandler	PDF builder handler
	 * @param	string				$action		'add', 'update', 'view'
	 * @return	int								Return integer <0 if KO,
	 * 											=0 if OK but we want to process standard actions too,
	 *											>0 if OK and we want to replace standard actions.
	 */
	public function afterPDFCreation($parameters, &$pdfhandler, &$action)
	{
		global $conf, $user, $langs;
		global $hookmanager;

		$outputlangs = $langs;

		$ret = 0;
		$deltemp = array();
		dol_syslog(get_class($this).'::executeHooks action='.$action);

		/* print_r($parameters); print_r($object); echo "action: " . $action; */
		// @phan-suppress-next-line PhanPluginEmptyStatementIf
		if (in_array($parameters['currentcontext'], array('somecontext1', 'somecontext2'))) {
			// do something only for the context 'somecontext1' or 'somecontext2'
		}

		return $ret;
	}



	/**
	 * Overload the loadDataForCustomReports function : returns data to complete the customreport tool
	 *
	 * @param	array<string,mixed>	$parameters		Hook metadata (context, etc...)
	 * @param	?string				$action 		Current action (if set). Generally create or edit or null
	 * @param	HookManager			$hookmanager    Hook manager propagated to allow calling another hook
	 * @return	int									Return integer < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function loadDataForCustomReports($parameters, &$action, $hookmanager)
	{
		global $langs;

		$langs->load("fastmodulecheck@fastmodulecheck");

		$this->results = array();

		$head = array();
		$h = 0;

		if ($parameters['tabfamily'] == 'fastmodulecheck') {
			$head[$h][0] = dol_buildpath('/module/index.php', 1);
			$head[$h][1] = $langs->trans("Home");
			$head[$h][2] = 'home';
			$h++;

			$this->results['title'] = $langs->trans("Fastmodulecheck");
			$this->results['picto'] = 'fastmodulecheck@fastmodulecheck';
		}

		$head[$h][0] = 'customreports.php?objecttype='.$parameters['objecttype'].(empty($parameters['tabfamily']) ? '' : '&tabfamily='.$parameters['tabfamily']);
		$head[$h][1] = $langs->trans("CustomReports");
		$head[$h][2] = 'customreports';

		$this->results['head'] = $head;

		$arrayoftypes = array();
		//$arrayoftypes['fastmodulecheck_myobject'] = array('label' => 'MyObject', 'picto'=>'myobject@fastmodulecheck', 'ObjectClassName' => 'MyObject', 'enabled' => isModEnabled('fastmodulecheck'), 'ClassPath' => "/fastmodulecheck/class/myobject.class.php", 'langs'=>'fastmodulecheck@fastmodulecheck')

		$this->results['arrayoftype'] = $arrayoftypes;

		return 0;
	}



	/**
	 * Overload the restrictedArea function : check permission on an object
	 *
	 * @param	array<string,mixed>	$parameters		Hook metadata (context, etc...)
	 * @param	string				$action			Current action (if set). Generally create or edit or null
	 * @param	HookManager			$hookmanager	Hook manager propagated to allow calling another hook
	 * @return	int									Return integer <0 if KO,
	 *												=0 if OK but we want to process standard actions too,
	 *												>0 if OK and we want to replace standard actions.
	 */
	public function restrictedArea($parameters, &$action, $hookmanager)
	{
		global $user;

		if ($parameters['features'] == 'myobject') {
			if ($user->hasRight('fastmodulecheck', 'myobject', 'read')) {
				$this->results['result'] = 1;
				return 1;
			} else {
				$this->results['result'] = 0;
				return 1;
			}
		}

		return 0;
	}

	/**
	 * Execute action completeTabsHead
	 *
	 * @param	array<string,mixed>	$parameters		Array of parameters
	 * @param	CommonObject		$object			The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param	string				$action			'add', 'update', 'view'
	 * @param	Hookmanager			$hookmanager	Hookmanager
	 * @return	int									Return integer <0 if KO,
	 *												=0 if OK but we want to process standard actions too,
	 *												>0 if OK and we want to replace standard actions.
	 */
	public function completeTabsHead(&$parameters, &$object, &$action, $hookmanager)
	{
		global $langs, $conf, $user;

		if (!isset($parameters['object']->element)) {
			return 0;
		}
		if ($parameters['mode'] == 'remove') {
			// used to make some tabs removed
			return 0;
		} elseif ($parameters['mode'] == 'add') {
			$langs->load('fastmodulecheck@fastmodulecheck');
			// used when we want to add some tabs
			$counter = count($parameters['head']);
			$element = $parameters['object']->element;
			$id = $parameters['object']->id;
			// verifier le type d'onglet comme member_stats où ça ne doit pas apparaitre
			// if (in_array($element, ['societe', 'member', 'contrat', 'fichinter', 'project', 'propal', 'commande', 'facture', 'order_supplier', 'invoice_supplier'])) {
			if (in_array($element, ['context1', 'context2'])) {
				$datacount = 0;

				$parameters['head'][$counter][0] = dol_buildpath('/fastmodulecheck/fastmodulecheck_tab.php', 1) . '?id=' . $id . '&amp;module='.$element;
				$parameters['head'][$counter][1] = $langs->trans('FastmodulecheckTab');
				if ($datacount > 0) {
					$parameters['head'][$counter][1] .= '<span class="badge marginleftonlyshort">' . $datacount . '</span>';
				}
				$parameters['head'][$counter][2] = 'fastmodulecheckemails';
				$counter++;
			}
			if ($counter > 0 && (int) DOL_VERSION < 14) {
				$this->results = $parameters['head'];
				// return 1 to replace standard code
				return 1;
			} else {
				// From V14 onwards, $parameters['head'] is modifiable by referende
				return 0;
			}
		} else {
			// Bad value for $parameters['mode']
			return -1;
		}
	}

	/**
	 * Execute action printTopRightMenu
	 *
	 * @param	array<string,mixed>	$parameters		Array of parameters
	 * @param	CommonObject		$object			The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param	string				$action			'add', 'update', 'view'
	 * @param	Hookmanager			$hookmanager	Hookmanager
	 * @return	int									Return integer <0 if KO,
	 *												=0 if OK but we want to process standard actions too,
	 *												>0 if OK and we want to replace standard actions.
	 */
	public function printTopRightMenu(&$parameters, &$object, &$action, $hookmanager) {
		global $conf, $user, $langs, $mysoc, $db;

		require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';

		$error = 0; // Error counter
		$contexts = explode(':', $parameters['context'] ?? '');

		if (in_array('toprightmenu', $contexts)) {
			// var_dump($conf);
			$moduldir = dolGetModulesDirs();

			foreach ($moduldir as $mod) {
				// Load modules attributes in arrays (name, numero, orders) from mod modectory
				//print $mod."\n<br>";
				dol_syslog("Scan modectory ".$mod." for module descriptor files (modXXX.class.php)");
				$handle = @opendir($mod);
				if (is_resource($handle)) {
					while (($file = readdir($handle)) !== false) {
						//print "$i ".$file."\n<br>";
						if (is_readable($mod.$file) && substr($file, 0, 3) == 'mod' && substr($file, dol_strlen($file) - 10) == '.class.php') {
							$modName = substr($file, 0, dol_strlen($file) - 10);
							var_dump($modName);
							if ($modName) {
								if (!empty($modNameLoaded[$modName])) {   // In cache of already loaded modules ?
									$mesg = "Error: Module ".$modName." was found twice: Into ".$modNameLoaded[$modName]." and ".$mod.". You probably have an old file on your disk.<br>";
									setEventMessages($mesg, null, 'warnings');
									dol_syslog($mesg, LOG_ERR);
									continue;
								}
			
								try {
									$res = include_once $mod.$file; // A class already exists in a different file will send a non catchable fatal error.
									if (class_exists($modName)) {
										$objMod = new $modName($db);
										'@phan-var-force DolibarrModules $objMod';
										$modNameLoaded[$modName] = $mod;
										if (!$objMod->numero > 0 && $modName != 'modUser') {
											dol_syslog('The module descriptor '.$modName.' must have a numero property', LOG_ERR);
										}
										$j = $objMod->numero;
			
										$modulequalified = 1;
			
										// We discard modules according to features level (PS: if module is activated we always show it)
										$const_name = 'MAIN_MODULE_'.strtoupper(preg_replace('/^mod/i', '', get_class($objMod)));
										if ($objMod->version == 'development' && (!getDolGlobalString($const_name) && (getDolGlobalInt('MAIN_FEATURES_LEVEL') < 2))) {
											$modulequalified = 0;
										}
										if ($objMod->version == 'experimental' && (!getDolGlobalString($const_name) && (getDolGlobalInt('MAIN_FEATURES_LEVEL') < 1))) {
											$modulequalified = 0;
										}
										if (preg_match('/deprecated/', $objMod->version) && (!getDolGlobalString($const_name) && (getDolGlobalInt('MAIN_FEATURES_LEVEL') >= 0))) {
											$modulequalified = 0;
										}
			
										// We discard modules according to property ->hidden
										if (!empty($objMod->hidden)) {
											$modulequalified = 0;
										}
			
										if ($modulequalified > 0) {
											$publisher = dol_escape_htmltag($objMod->getPublisher());
											$external = ($objMod->isCoreOrExternalModule() == 'external');
											if ($external) {
												if ($publisher) {
													// Check if there is a logo forpublisher
													/* Do not show the company logo in combo. Make combo list modty.
													if (!empty($objMod->editor_squarred_logo)) {
														$publisherlogoarray['external_'.$publisher] = img_picto('', $objMod->editor_squarred_logo, 'class="publisherlogoinline"');
													}
													$publisherlogo = empty($publisherlogoarray['external_'.$publisher]) ? '' : $publisherlogoarray['external_'.$publisher];
													*/
													$arrayofnatures['external_'.$publisher] = array('label' => $langs->trans("External").' - '.$publisher, 'data-html' => $langs->trans("External").' - <span class="opacitymedium inine-block valignmiddle">'.$publisher.'</span>');
												} else {
													$arrayofnatures['external_'] = array('label' => $langs->trans("External").' - ['.$langs->trans("UnknownPublishers").']');
												}
											}
											ksort($arrayofnatures);
			
											// Define an array $categ with categ with at least one qualified module
											$filename[$i] = $modName;
											$modules[$modName] = $objMod;
			
											// Gives the possibility to the module, to provide his own family info and position of this family
											if (is_array($objMod->familyinfo) && !empty($objMod->familyinfo)) {
												$familyinfo = array_merge($familyinfo, $objMod->familyinfo);
												$familykey = key($objMod->familyinfo);
											} else {
												$familykey = $objMod->family;
											}
											'@phan-var-force string $familykey';  // if not, phan considers $familykey may be null
			
											$moduleposition = ($objMod->module_position ? $objMod->module_position : '50');
											if ($objMod->isCoreOrExternalModule() == 'external' && $moduleposition < 100000) {
												// an external module should never return a value lower than '80'.
												$moduleposition = '80'; // External modules at end by default
											}
			
											// Add list of warnings to show into arrayofwarnings and arrayofwarningsext
											if (!empty($objMod->warnings_activation)) {
												$arrayofwarnings[$modName] = $objMod->warnings_activation;
											}
											if (!empty($objMod->warnings_activation_ext)) {
												$arrayofwarningsext[$modName] = $objMod->warnings_activation_ext;
											}
			
											$familyposition = (empty($familyinfo[$familykey]['position']) ? '0' : $familyinfo[$familykey]['position']);
											$listOfOfficialModuleGroups = array('hr', 'technic', 'interface', 'technic', 'portal', 'financial', 'crm', 'base', 'products', 'srm', 'ecm', 'projects', 'other');
											if ($external && !in_array($familykey, $listOfOfficialModuleGroups)) {
												// If module is extern and into a custom group (not into an official predefined one), it must appear at end (custom groups should not be before official groups).
												if (is_numeric($familyposition)) {
													$familyposition = sprintf("%03d", (int) $familyposition + 100);
												}
											}
			
											$orders[$i] = $familyposition."_".$familykey."_".$moduleposition."_".$j; // Sort by family, then by module position then number
			
											// Set categ[$i]
											$specialstring = 'unknown';
											if ($objMod->version == 'development' || $objMod->version == 'experimental') {
												$specialstring = 'expdev';
											}
											if (isset($categ[$specialstring])) {
												$categ[$specialstring]++; // Array of all different modules categories
											} else {
												$categ[$specialstring] = 1;
											}
											$j++;
											$i++;
										} else {
											dol_syslog("Module ".get_class($objMod)." not qualified");
										}
									} else {
										print info_admin("admin/modules.php Warning bad descriptor file : ".$mod.$file." (Class ".$modName." not found into file)", 0, 0, '1', 'warning');
									}
								} catch (Exception $e) {
									dol_syslog("Failed to load ".$mod.$file." ".$e->getMessage(), LOG_ERR);
								}
							}
						}
					}
				}
			}
			
			$menu = '
			<button id="toggleButton" onclick="toggleTable()">Afficher le tableau</button>
			<table id="hiddenTable" style="display:none; border: 1px solid black;">
				<tr>
					<th>Colonne 1</th>
					<th>Colonne 2</th>
				</tr>
			</table>';

			$this->resprints .= $menu . '
			<script>
				function toggleTable() {
					var table = document.getElementById("hiddenTable");
					var button = document.getElementById("toggleButton");
					if (table.style.display === "none") {
						table.style.display = "table";
						button.textContent = "Cacher le tableau";
					} else {
						table.style.display = "none";
						button.textContent = "Afficher le tableau";
					}
				}
			</script>';
		}
	}

	/* Add other hook methods here... */
}
