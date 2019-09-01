<?php

return [
    
    [['GET', 'POST'], '/adminconsole', ['Controllers\ConsoleController', 'display']],
    [['GET', 'POST'], '/report/{name}/{format}', ['Controllers\ReportController', 'display']],
    [['GET', 'POST'], '/officer', ['Controllers\OfficerPaymentController', 'display']],
    [['GET', 'POST'], '/password', ['Controllers\PasswordController', 'display']],
    [['GET', 'POST'], '/employee/create', ['Controllers\EmployeeCreateController', 'display']],
    [['GET', 'POST'], '/employee/edit', ['Controllers\EmployeeEditController', 'display']],
    [['GET', 'POST'], '/employee/view', ['Controllers\EmployeeViewController', 'display']],
    [['GET', 'POST'], '/employee/deactivate', ['Controllers\EmployeeDeactivateController', 'display']],
    [['GET', 'POST'], '/event/create', ['Controllers\EventCreateController', 'display']],
    [['GET', 'POST'], '/event/edit', ['Controllers\EventEditController', 'display']],
    [['GET', 'POST'], '/event/view', ['Controllers\EventViewController', 'display']],
    [['GET', 'POST'], '/proforma/create', ['Controllers\MakeProformaController', 'display']],
    [['GET', 'POST'], '/proforma/edit', ['Controllers\EditProformaController', 'display']],
    [['GET', 'POST'], '/proforma/amend', ['Controllers\AmendProformaController', 'display']],
    [['GET', 'POST'], '/event/deactivate', ['Controllers\EventDeactivateController', 'display']],
    [['GET', 'POST'], '/admin/account/create', ['Controllers\AccountCreateController', 'display']],
    [['GET', 'POST'], '/admin/equipment/create', ['Controllers\EquipmentCreateController', 'display']],
    [['GET', 'POST'], '/admin/station/create', ['Controllers\StationCreateController', 'display']],
    [['GET', 'POST'], '/admin/workflow/create', ['Controllers\WorkflowCreateController', 'display']],
    [['GET', 'POST'], '/admin/config/create', ['Controllers\ConfigCreateController', 'display']],
    [['GET', 'POST'], '/equipment/create', ['Controllers\EquipmentCreateController', 'display']],
    [['GET', 'POST'], '/equipment/edit', ['Controllers\EquipmentEditController', 'display']],
    [['GET', 'POST'], '/equipment/deactivate', ['Controllers\EquipmentDeactivateController', 'display']],
    [['GET', 'POST'], '/account/create', ['Controllers\AccountCreateController', 'display']],
    [['GET', 'POST'], '/account/edit', ['Controllers\AccountEditController', 'display']],
    [['GET', 'POST'], '/account/deactivate', ['Controllers\AccountDeactivateController', 'display']],
    [['GET', 'POST'], '/station/create', ['Controllers\StationCreateController', 'display']],
    [['GET', 'POST'], '/station/edit', ['Controllers\StationEditController', 'display']],
    [['GET', 'POST'], '/station/deactivate', ['Controllers\StationDeactivateController', 'display']],
    [['GET', 'POST'], '/workflow/create', ['Controllers\WorkflowCreateController', 'display']],
    [['GET', 'POST'], '/workflow/edit', ['Controllers\WorkflowEditController', 'display']],
    [['GET', 'POST'], '/config/create', ['Controllers\ConfigCreateController', 'display']],
    [['GET', 'POST'], '/config/edit', ['Controllers\ConfigEditController', 'display']],
    [['GET', 'POST'], '/config/deactivate', ['Controllers\ConfigDeactivateController', 'display']],
    [['GET', 'POST'], '/company/create', ['Controllers\CompanyCreateController', 'display']],
    [['GET', 'POST'], '/company/edit', ['Controllers\CompanyEditController', 'display']],
    [['GET', 'POST'], '/company/deactivate', ['Controllers\CompanyDeactivateController', 'display']],
    [['GET', 'POST'], '/admin/createuser', ['Controllers\CreateAdminUserController', 'display']],
    [['GET', 'POST'], '/admin/edituser', ['Controllers\EditAdminUserController', 'display']],
    [['GET', 'POST'], '/admin/managepot', ['Controllers\ManagePOTController', 'display']],
    [['GET', 'POST'], '/createpayment', ['Controllers\MakePaymentController', 'display']],
    [['GET', 'POST'], '/editproforma', ['Controllers\EditProformaController', 'display']],
    [['GET', 'POST'], '/amendpayment', ['Controllers\AmendPaymentController', 'display']],
    [['GET', 'POST'], '/createdutysheet', ['Controllers\CreateDutySheetController', 'display']],
    [['GET', 'POST'], '/approve', ['Controllers\ApproveCreateController', 'display']],
    
    [['GET', 'POST'], '/flexi/create', ['Controllers\FlexiCreateController', 'display']],
    [['GET', 'POST'], '/flexi/edit', ['Controllers\EditFlexiController', 'display']],
    
    [['GET', 'POST'], '/specops/create', ['Controllers\SpecOpsCreateController', 'display']],
    [['GET', 'POST'], '/specops/edit', ['Controllers\EditSpecopsController', 'display']],
    
    [['GET', 'POST'], '/court/create', ['Controllers\CourtCreateController', 'display']],
    [['GET', 'POST'], '/court/edit', ['Controllers\EditCourtController', 'display']],
   
    [['GET', 'POST'], '/dutysheet/edit', ['Controllers\EditDutySheetController', 'display']],
    [['GET', 'POST'], '/admin/processpayroll', ['Controllers\PayrollController', 'display']],
    [['GET', 'POST'], '/proformatablepymt', ['Controllers\ProformaTableController', 'display']],
    [['GET', 'POST'], '/dutysheettablepymt', ['Controllers\DutySheetTableController', 'display']],
    [['GET', 'POST'], '/success', ['Controllers\SuccessController', 'display']],
//    [['GET'], '/unlockpymt', ['Controllers\PaymentUnlockController', 'display']],
    [['GET', 'POST'], '/tableprn', ['Controllers\PRNTableController', 'display']],
    [['GET'], '/unlockprn', ['Controllers\PRNUnlockController', 'display']],
    [['GET', 'POST'], '/editprn', ['Controllers\EditPRNController', 'display']],
    [['GET', 'POST'], '/createdeposit', ['Controllers\MakeDepositController', 'display']],
    [['GET', 'POST'], '/createrefund', ['Controllers\MakeRefundController', 'display']],
    [['GET', 'POST'], '/disburseprn', ['Controllers\DisburseController', 'display']],
    [['GET', 'POST'], '/employee', ['Controllers\EmployeeController', 'display']],
    [['GET', 'POST'], '/report/{name:POTEmployeeSummary|POTPaymentByEntityCombined|POTPaymentByEntityIndividual|POTPayslips}', ['Controllers\PaymentsReportController', 'display']],
    [['GET', 'POST'], '/report/{name:POTEntityDetails|POTEntitySummary|PrnEntity|RefundEntity|PotEmployeeDetails|POTPRNByEntity|POTRefundByEntity|CompanyListing|EmployeeListing|ReceiptsByEntityCombined|ReceiptsByEntityIndividual}', ['Controllers\ManagersReportController', 'display']],
    ['GET', '/index.php', ['Controllers\Homepage', 'display']],
    ['GET', '/', ['Controllers\Homepage', 'display']],
    [['GET', 'POST'], '/login', ['Controllers\Login', 'show']],
    [['GET', 'POST'], '/changepassword', ['Controllers\PasswordController', 'display']],
    [['GET', 'POST'], '/logout', ['Controllers\Login', 'logout']],
];
