<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "login";
$route['404_override'] = 'error_404';


/*********** USER DEFINED ROUTES *******************/

$route['login-me'] = 'login/loginMe';
$route['dashboard'] = 'dashboard';
$route['profile'] = "user/profile";
$route['profile/(:any)'] = "user/profile/$1";
$route['profile-update'] = "user/profileUpdate";
$route['profile-update/(:any)'] = "user/profileUpdate/$1";
$route['change-password'] = "user/changePassword";
$route['logout'] = 'user/logout';
$route['page-not-found'] = "user/pageNotFound";

/******* User Routes ***********/
$route['user-list'] = 'user/userListing';
$route['login-history'] = "user/loginHistoy";
$route['login-history/(:any)'] = "user/loginHistoy/$1";
$route['add-new-user'] = "user/addNewUser";
$route['save-new-user'] = "user/saveNewUser";
$route['edit-old-user'] = "user/editOldUser";
$route['edit-old-user/(:any)'] = "user/editOldUser/$1";
$route['user-update'] = "user/userUpdate";
$route['user-activated'] = "user/userActivated";
$route['delete-user'] = "user/deleteUser";

/******* Disease Routes ***********/
$route['disease-list'] = 'disease/diseaseListing';
$route['add-new-disease'] = "disease/addNewDisease";
$route['save-new-disease'] = "disease/saveNewDisease";
$route['edit-old-disease'] = "disease/editOldDisease";
$route['edit-old-disease/(:any)'] = "disease/editOldDisease/$1";
$route['disease-update'] = "disease/diseaseUpdate";
$route['delete-disease'] = "disease/deleteDisease";

/******* Symptom Routes ***********/
$route['symptom-list'] = 'symptom/symptomListing';
$route['add-new-symptom'] = "symptom/addNewSymptom";
$route['save-new-symptom'] = "symptom/saveNewSymptom";
$route['edit-old-symptom'] = "symptom/editOldSymptom";
$route['edit-old-symptom/(:any)'] = "symptom/editOldSymptom/$1";
$route['symptom-update'] = "symptom/symptomUpdate";
$route['delete-symptom'] = "symptom/deleteSymptom";

/******* Rule Routes ***********/
$route['rule-list'] = 'rule/ruleListing';
$route['add-new-rule'] = "rule/addNewRule";
$route['save-new-rule'] = "rule/saveNewRule";
$route['view-old-rule'] = "rule/viewOldRule";
$route['view-old-rule/(:any)'] = "rule/viewOldRule/$1";
$route['edit-old-rule'] = "rule/editOldRule";
$route['edit-old-rule/(:any)'] = "rule/editOldRule/$1";
$route['checkSymptomExists'] = "rule/checkSymptomExists";
$route['rule-update'] = "rule/ruleUpdate";
$route['delete-rule'] = "rule/deleteRule";

/******* Diagnosis Routes ***********/
$route['diagnosis-list'] = 'diagnosis/diagnosisListing';
$route['edit-old-patient'] = "diagnosis/editOldPatient";
$route['edit-old-patient/(:any)'] = "diagnosis/editOldPatient/$1";
$route['patient-update'] = "diagnosis/patientUpdate";
$route['medical-records-list'] = "diagnosis/medicalRecordListing";
$route['medical-records-list/(:any)'] = "diagnosis/medicalRecordListing/$1";
$route['view-old-diagnosis'] = "diagnosis/viewOldDiagnosis";
$route['view-old-diagnosis/(:any)'] = "diagnosis/viewOldDiagnosis/$1";
$route['print-old-diagnosis'] = "diagnosis/printOldDiagnosis";
$route['print-old-diagnosis/(:any)'] = "diagnosis/printOldDiagnosis/$1";
$route['print-diagnosis/(:any)'] = "diagnosis/printDiagnosis/$1";
$route['add-new-diagnosis'] = "diagnosis/addNewDiagnosis";
$route['save-new-tmp-diagnosis'] = "diagnosis/saveNewTmpDiagnosis";
$route['add-new-patient'] = "diagnosis/addNewPatient";
$route['save-new-patient'] = "diagnosis/saveNewPatient";
$route['show-symptom-list'] = "diagnosis/showSymptomList";
$route['add-symptom-session'] = "diagnosis/addSymptomSession";
$route['save-new-diagnosis'] = "diagnosis/saveNewDiagnosis";
$route['delete-diagnosis'] = "diagnosis/deleteDiagnosis";

/* End of file routes.php */
/* Location: ./application/config/routes.php */