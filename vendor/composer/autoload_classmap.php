<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Controllers\\AccountCreateController' => $baseDir . '/Controller/Account/Create.php',
    'Controllers\\AccountDeactivateController' => $baseDir . '/Controller/Account/Delete.php',
    'Controllers\\AccountEditController' => $baseDir . '/Controller/Account/Edit.php',
    'Controllers\\AddOfficerController' => $baseDir . '/Controller/DutySheet/Create.php',
    'Controllers\\AmendPaymentController' => $baseDir . '/Controller/Payment/Amend.php',
    'Controllers\\BaseController' => $baseDir . '/Controller/base_template.php',
    'Controllers\\BaseTemplate' => $baseDir . '/Controller/base_template.php',
    'Controllers\\CompanyCreateController' => $baseDir . '/Controller/Company/Create.php',
    'Controllers\\CompanyDeactivateController' => $baseDir . '/Controller/Company/Delete.php',
    'Controllers\\CompanyEditController' => $baseDir . '/Controller/Company/Edit.php',
    'Controllers\\ConfigCreateController' => $baseDir . '/Controller/Config/Create.php',
    'Controllers\\ConfigEditController' => $baseDir . '/Controller/Config/Edit.php',
    'Controllers\\ConsoleController' => $baseDir . '/Controller/Admin/ConsoleManager.php',
    'Controllers\\CreateAdminUserController' => $baseDir . '/Controller/Admin/CreateUser.php',
    'Controllers\\CreateDutySheetController' => $baseDir . '/Controller/DutySheet/Create.php',
    'Controllers\\DisburseController' => $baseDir . '/Controller/PRNGen/PRNGenerate.php',
    'Controllers\\EditAdminUserController' => $baseDir . '/Controller/Admin/EditUser.php',
    'Controllers\\EditPRNController' => $baseDir . '/Controller/PRNGen/PRNGenerate.php',
    'Controllers\\EditPaymentController' => $baseDir . '/Controller/Payment/Edit.php',
    'Controllers\\EmployeeCreateController' => $baseDir . '/Controller/Employee/Create.php',
    'Controllers\\EmployeeDeactivateController' => $baseDir . '/Controller/Employee/Delete.php',
    'Controllers\\EmployeeEditController' => $baseDir . '/Controller/Employee/Edit.php',
    'Controllers\\EquipmentCreateController' => $baseDir . '/Controller/Equipment/Create.php',
    'Controllers\\EquipmentDeactivateController' => $baseDir . '/Controller/Equipment/Delete.php',
    'Controllers\\EquipmentEditController' => $baseDir . '/Controller/Equipment/Edit.php',
    'Controllers\\Error' => $baseDir . '/Controller/ErrorController.php',
    'Controllers\\EventCreateController' => $baseDir . '/Controller/Event/Create.php',
    'Controllers\\EventDeactivateController' => $baseDir . '/Controller/Event/Delete.php',
    'Controllers\\EventEditController' => $baseDir . '/Controller/Event/Edit.php',
    'Controllers\\Homepage' => $baseDir . '/Controller/HomepageController.php',
    'Controllers\\LoggedInController' => $baseDir . '/Controller/base_template.php',
    'Controllers\\Login' => $baseDir . '/Controller/LoginController.php',
    'Controllers\\MakeDepositController' => $baseDir . '/Controller/Deposit/Create.php',
    'Controllers\\MakePaymentController' => $baseDir . '/Controller/Payment/Create.php',
    'Controllers\\MakeRefundController' => $baseDir . '/Controller/Refund/Create.php',
    'Controllers\\ManagePOTController' => $baseDir . '/Controller/Admin/ManagePOT.php',
    'Controllers\\ManagersReportController' => $baseDir . '/Controller/Reports/ReportController.php',
    'Controllers\\MasterTemplate' => $baseDir . '/Controller/base_template.php',
    'Controllers\\OfficerPaymentController' => $baseDir . '/Controller/Payment/Create.php',
    'Controllers\\PRNTableController' => $baseDir . '/Controller/PRNGen/PRNGenerate.php',
    'Controllers\\PRNUnlockController' => $baseDir . '/Controller/PRNGen/PRNGenerate.php',
    'Controllers\\PasswordController' => $baseDir . '/Controller/PasswordController.php',
    'Controllers\\PaymentTableController' => $baseDir . '/Controller/Payment/Edit.php',
    'Controllers\\PaymentUnlockController' => $baseDir . '/Controller/Payment/Edit.php',
    'Controllers\\PaymentsReportController' => $baseDir . '/Controller/Reports/PaymentsReportController.php',
    'Controllers\\PayrollController' => $baseDir . '/Controller/Payroll/Process.php',
    'Controllers\\PermissionController' => $baseDir . '/Controller/base_template.php',
    'Controllers\\ReportController' => $baseDir . '/Controller/Reports/ReportController_old.php',
    'Controllers\\StationCreateController' => $baseDir . '/Controller/Station/Create.php',
    'Controllers\\StationEditController' => $baseDir . '/Controller/Station/Edit.php',
    'Controllers\\SuccessController' => $baseDir . '/Controller/Success/Show.php',
    'Controllers\\WorkflowCreateController' => $baseDir . '/Controller/Workflow/Create.php',
    'Controllers\\WorkflowEditController' => $baseDir . '/Controller/Workflow/Edit.php',
    'FastRoute\\BadRouteException' => $vendorDir . '/nikic/fast-route/src/BadRouteException.php',
    'FastRoute\\DataGenerator' => $vendorDir . '/nikic/fast-route/src/DataGenerator.php',
    'FastRoute\\DataGenerator\\CharCountBased' => $vendorDir . '/nikic/fast-route/src/DataGenerator/CharCountBased.php',
    'FastRoute\\DataGenerator\\GroupCountBased' => $vendorDir . '/nikic/fast-route/src/DataGenerator/GroupCountBased.php',
    'FastRoute\\DataGenerator\\GroupPosBased' => $vendorDir . '/nikic/fast-route/src/DataGenerator/GroupPosBased.php',
    'FastRoute\\DataGenerator\\MarkBased' => $vendorDir . '/nikic/fast-route/src/DataGenerator/MarkBased.php',
    'FastRoute\\DataGenerator\\RegexBasedAbstract' => $vendorDir . '/nikic/fast-route/src/DataGenerator/RegexBasedAbstract.php',
    'FastRoute\\Dispatcher' => $vendorDir . '/nikic/fast-route/src/Dispatcher.php',
    'FastRoute\\Dispatcher\\CharCountBased' => $vendorDir . '/nikic/fast-route/src/Dispatcher/CharCountBased.php',
    'FastRoute\\Dispatcher\\GroupCountBased' => $vendorDir . '/nikic/fast-route/src/Dispatcher/GroupCountBased.php',
    'FastRoute\\Dispatcher\\GroupPosBased' => $vendorDir . '/nikic/fast-route/src/Dispatcher/GroupPosBased.php',
    'FastRoute\\Dispatcher\\MarkBased' => $vendorDir . '/nikic/fast-route/src/Dispatcher/MarkBased.php',
    'FastRoute\\Dispatcher\\RegexBasedAbstract' => $vendorDir . '/nikic/fast-route/src/Dispatcher/RegexBasedAbstract.php',
    'FastRoute\\Route' => $vendorDir . '/nikic/fast-route/src/Route.php',
    'FastRoute\\RouteCollector' => $vendorDir . '/nikic/fast-route/src/RouteCollector.php',
    'FastRoute\\RouteParser' => $vendorDir . '/nikic/fast-route/src/RouteParser.php',
    'FastRoute\\RouteParser\\Std' => $vendorDir . '/nikic/fast-route/src/RouteParser/Std.php',
    'Jaspersoft\\Client\\Client' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Client/Client.php',
    'Jaspersoft\\Dto\\Attribute\\Attribute' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Attribute/Attribute.php',
    'Jaspersoft\\Dto\\ImportExport\\ExportTask' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/ImportExport/ExportTask.php',
    'Jaspersoft\\Dto\\ImportExport\\ImportTask' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/ImportExport/ImportTask.php',
    'Jaspersoft\\Dto\\ImportExport\\TaskState' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/ImportExport/TaskState.php',
    'Jaspersoft\\Dto\\Job\\Alert' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/Alert.php',
    'Jaspersoft\\Dto\\Job\\CalendarTrigger' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/CalendarTrigger.php',
    'Jaspersoft\\Dto\\Job\\Job' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/Job.php',
    'Jaspersoft\\Dto\\Job\\JobState' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/JobState.php',
    'Jaspersoft\\Dto\\Job\\JobSummary' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/JobSummary.php',
    'Jaspersoft\\Dto\\Job\\MailNotification' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/MailNotification.php',
    'Jaspersoft\\Dto\\Job\\OutputFTPInfo' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/OutputFTPInfo.php',
    'Jaspersoft\\Dto\\Job\\RepositoryDestination' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/RepositoryDestination.php',
    'Jaspersoft\\Dto\\Job\\SimpleTrigger' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/SimpleTrigger.php',
    'Jaspersoft\\Dto\\Job\\Source' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/Source.php',
    'Jaspersoft\\Dto\\Job\\Trigger' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/Trigger.php',
    'Jaspersoft\\Dto\\Options\\ReportOptions' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Options/ReportOptions.php',
    'Jaspersoft\\Dto\\Organization\\Organization' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Organization/Organization.php',
    'Jaspersoft\\Dto\\Permission\\RepositoryPermission' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Permission/RepositoryPermission.php',
    'Jaspersoft\\Dto\\ReportExecution\\Execution' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/ReportExecution/Execution.php',
    'Jaspersoft\\Dto\\ReportExecution\\ExecutionRequest' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/ReportExecution/ExecutionRequest.php',
    'Jaspersoft\\Dto\\Report\\InputControl' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Report/InputControl.php',
    'Jaspersoft\\Dto\\Resource\\AdhocDataView' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/AdhocDataView.php',
    'Jaspersoft\\Dto\\Resource\\AwsDataSource' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/AwsDataSource.php',
    'Jaspersoft\\Dto\\Resource\\BeanDataSource' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/BeanDataSource.php',
    'Jaspersoft\\Dto\\Resource\\CollectiveResource' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/CollectiveResource.php',
    'Jaspersoft\\Dto\\Resource\\CompositeResource' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/CompositeResource.php',
    'Jaspersoft\\Dto\\Resource\\CustomDataSource' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/CustomDataSource.php',
    'Jaspersoft\\Dto\\Resource\\Dashboard' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/Dashboard.php',
    'Jaspersoft\\Dto\\Resource\\DataType' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/DataType.php',
    'Jaspersoft\\Dto\\Resource\\DomainTopic' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/DomainTopic.php',
    'Jaspersoft\\Dto\\Resource\\File' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/File.php',
    'Jaspersoft\\Dto\\Resource\\Folder' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/Folder.php',
    'Jaspersoft\\Dto\\Resource\\InputControl' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/InputControl.php',
    'Jaspersoft\\Dto\\Resource\\JdbcDataSource' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/JdbcDataSource.php',
    'Jaspersoft\\Dto\\Resource\\JndiJdbcDataSource' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/JndiJdbcDataSource.php',
    'Jaspersoft\\Dto\\Resource\\ListOfValues' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/ListOfValues.php',
    'Jaspersoft\\Dto\\Resource\\MondrianConnection' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/MondrianConnection.php',
    'Jaspersoft\\Dto\\Resource\\MondrianXmlaDefinition' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/MondrianXmlaDefinition.php',
    'Jaspersoft\\Dto\\Resource\\OlapUnit' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/OlapUnit.php',
    'Jaspersoft\\Dto\\Resource\\Query' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/Query.php',
    'Jaspersoft\\Dto\\Resource\\ReportOptions' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/ReportOptions.php',
    'Jaspersoft\\Dto\\Resource\\ReportUnit' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/ReportUnit.php',
    'Jaspersoft\\Dto\\Resource\\Resource' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/Resource.php',
    'Jaspersoft\\Dto\\Resource\\ResourceLookup' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/ResourceLookup.php',
    'Jaspersoft\\Dto\\Resource\\SecureMondrianConnection' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/SecureMondrianConnection.php',
    'Jaspersoft\\Dto\\Resource\\SemanticLayerDataSource' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/SemanticLayerDataSource.php',
    'Jaspersoft\\Dto\\Resource\\VirtualDataSource' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/VirtualDataSource.php',
    'Jaspersoft\\Dto\\Resource\\XmlaConnection' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/XmlaConnection.php',
    'Jaspersoft\\Dto\\Role\\Role' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Role/Role.php',
    'Jaspersoft\\Dto\\User\\User' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/User/User.php',
    'Jaspersoft\\Dto\\User\\UserLookup' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Dto/User/UserLookup.php',
    'Jaspersoft\\Exception\\RESTRequestException' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Exception/RESTRequestException.php',
    'Jaspersoft\\Exception\\ResourceServiceException' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Exception/ResourceServiceException.php',
    'Jaspersoft\\Service\\Criteria\\Criterion' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Service/Criteria/Criterion.php',
    'Jaspersoft\\Service\\Criteria\\RepositorySearchCriteria' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Service/Criteria/RepositorySearchCriteria.php',
    'Jaspersoft\\Service\\ImportExportService' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Service/ImportExportService.php',
    'Jaspersoft\\Service\\JobService' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Service/JobService.php',
    'Jaspersoft\\Service\\OptionsService' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Service/OptionsService.php',
    'Jaspersoft\\Service\\OrganizationService' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Service/OrganizationService.php',
    'Jaspersoft\\Service\\PermissionService' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Service/PermissionService.php',
    'Jaspersoft\\Service\\QueryService' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Service/QueryService.php',
    'Jaspersoft\\Service\\ReportService' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Service/ReportService.php',
    'Jaspersoft\\Service\\RepositoryService' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Service/RepositoryService.php',
    'Jaspersoft\\Service\\Result\\SearchResourcesResult' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Service/Result/SearchResourcesResult.php',
    'Jaspersoft\\Service\\RoleService' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Service/RoleService.php',
    'Jaspersoft\\Service\\UserService' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Service/UserService.php',
    'Jaspersoft\\Tool\\CompositeDTOMapper' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Tool/CompositeDTOMapper.php',
    'Jaspersoft\\Tool\\DTOMapper' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Tool/DTOMapper.php',
    'Jaspersoft\\Tool\\MimeMapper' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Tool/MimeMapper.php',
    'Jaspersoft\\Tool\\RESTRequest' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Tool/RESTRequest.php',
    'Jaspersoft\\Tool\\TestUtils' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Tool/TestUtils.php',
    'Jaspersoft\\Tool\\Util' => $vendorDir . '/jaspersoft/rest-client/src/Jaspersoft/Tool/Util.php',
    'Monolog\\ErrorHandler' => $vendorDir . '/monolog/monolog/src/Monolog/ErrorHandler.php',
    'Monolog\\Formatter\\ChromePHPFormatter' => $vendorDir . '/monolog/monolog/src/Monolog/Formatter/ChromePHPFormatter.php',
    'Monolog\\Formatter\\ElasticaFormatter' => $vendorDir . '/monolog/monolog/src/Monolog/Formatter/ElasticaFormatter.php',
    'Monolog\\Formatter\\FlowdockFormatter' => $vendorDir . '/monolog/monolog/src/Monolog/Formatter/FlowdockFormatter.php',
    'Monolog\\Formatter\\FluentdFormatter' => $vendorDir . '/monolog/monolog/src/Monolog/Formatter/FluentdFormatter.php',
    'Monolog\\Formatter\\FormatterInterface' => $vendorDir . '/monolog/monolog/src/Monolog/Formatter/FormatterInterface.php',
    'Monolog\\Formatter\\GelfMessageFormatter' => $vendorDir . '/monolog/monolog/src/Monolog/Formatter/GelfMessageFormatter.php',
    'Monolog\\Formatter\\HtmlFormatter' => $vendorDir . '/monolog/monolog/src/Monolog/Formatter/HtmlFormatter.php',
    'Monolog\\Formatter\\JsonFormatter' => $vendorDir . '/monolog/monolog/src/Monolog/Formatter/JsonFormatter.php',
    'Monolog\\Formatter\\LineFormatter' => $vendorDir . '/monolog/monolog/src/Monolog/Formatter/LineFormatter.php',
    'Monolog\\Formatter\\LogglyFormatter' => $vendorDir . '/monolog/monolog/src/Monolog/Formatter/LogglyFormatter.php',
    'Monolog\\Formatter\\LogstashFormatter' => $vendorDir . '/monolog/monolog/src/Monolog/Formatter/LogstashFormatter.php',
    'Monolog\\Formatter\\MongoDBFormatter' => $vendorDir . '/monolog/monolog/src/Monolog/Formatter/MongoDBFormatter.php',
    'Monolog\\Formatter\\NormalizerFormatter' => $vendorDir . '/monolog/monolog/src/Monolog/Formatter/NormalizerFormatter.php',
    'Monolog\\Formatter\\ScalarFormatter' => $vendorDir . '/monolog/monolog/src/Monolog/Formatter/ScalarFormatter.php',
    'Monolog\\Formatter\\WildfireFormatter' => $vendorDir . '/monolog/monolog/src/Monolog/Formatter/WildfireFormatter.php',
    'Monolog\\Handler\\AbstractHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/AbstractHandler.php',
    'Monolog\\Handler\\AbstractProcessingHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/AbstractProcessingHandler.php',
    'Monolog\\Handler\\AbstractSyslogHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/AbstractSyslogHandler.php',
    'Monolog\\Handler\\AmqpHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/AmqpHandler.php',
    'Monolog\\Handler\\BrowserConsoleHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/BrowserConsoleHandler.php',
    'Monolog\\Handler\\BufferHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/BufferHandler.php',
    'Monolog\\Handler\\ChromePHPHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/ChromePHPHandler.php',
    'Monolog\\Handler\\CouchDBHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/CouchDBHandler.php',
    'Monolog\\Handler\\CubeHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/CubeHandler.php',
    'Monolog\\Handler\\Curl\\Util' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/Curl/Util.php',
    'Monolog\\Handler\\DeduplicationHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/DeduplicationHandler.php',
    'Monolog\\Handler\\DoctrineCouchDBHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/DoctrineCouchDBHandler.php',
    'Monolog\\Handler\\DynamoDbHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/DynamoDbHandler.php',
    'Monolog\\Handler\\ElasticSearchHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/ElasticSearchHandler.php',
    'Monolog\\Handler\\ErrorLogHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/ErrorLogHandler.php',
    'Monolog\\Handler\\FilterHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/FilterHandler.php',
    'Monolog\\Handler\\FingersCrossedHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/FingersCrossedHandler.php',
    'Monolog\\Handler\\FingersCrossed\\ActivationStrategyInterface' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/FingersCrossed/ActivationStrategyInterface.php',
    'Monolog\\Handler\\FingersCrossed\\ChannelLevelActivationStrategy' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/FingersCrossed/ChannelLevelActivationStrategy.php',
    'Monolog\\Handler\\FingersCrossed\\ErrorLevelActivationStrategy' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/FingersCrossed/ErrorLevelActivationStrategy.php',
    'Monolog\\Handler\\FirePHPHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/FirePHPHandler.php',
    'Monolog\\Handler\\FleepHookHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/FleepHookHandler.php',
    'Monolog\\Handler\\FlowdockHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/FlowdockHandler.php',
    'Monolog\\Handler\\GelfHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/GelfHandler.php',
    'Monolog\\Handler\\GroupHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/GroupHandler.php',
    'Monolog\\Handler\\HandlerInterface' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/HandlerInterface.php',
    'Monolog\\Handler\\HandlerWrapper' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/HandlerWrapper.php',
    'Monolog\\Handler\\HipChatHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/HipChatHandler.php',
    'Monolog\\Handler\\IFTTTHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/IFTTTHandler.php',
    'Monolog\\Handler\\InsightOpsHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/InsightOpsHandler.php',
    'Monolog\\Handler\\LogEntriesHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/LogEntriesHandler.php',
    'Monolog\\Handler\\LogglyHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/LogglyHandler.php',
    'Monolog\\Handler\\MailHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/MailHandler.php',
    'Monolog\\Handler\\MandrillHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/MandrillHandler.php',
    'Monolog\\Handler\\MissingExtensionException' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/MissingExtensionException.php',
    'Monolog\\Handler\\MongoDBHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/MongoDBHandler.php',
    'Monolog\\Handler\\NativeMailerHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/NativeMailerHandler.php',
    'Monolog\\Handler\\NewRelicHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/NewRelicHandler.php',
    'Monolog\\Handler\\NullHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/NullHandler.php',
    'Monolog\\Handler\\PHPConsoleHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/PHPConsoleHandler.php',
    'Monolog\\Handler\\PsrHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/PsrHandler.php',
    'Monolog\\Handler\\PushoverHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/PushoverHandler.php',
    'Monolog\\Handler\\RavenHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/RavenHandler.php',
    'Monolog\\Handler\\RedisHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/RedisHandler.php',
    'Monolog\\Handler\\RollbarHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/RollbarHandler.php',
    'Monolog\\Handler\\RotatingFileHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/RotatingFileHandler.php',
    'Monolog\\Handler\\SamplingHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/SamplingHandler.php',
    'Monolog\\Handler\\SlackHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/SlackHandler.php',
    'Monolog\\Handler\\SlackWebhookHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/SlackWebhookHandler.php',
    'Monolog\\Handler\\Slack\\SlackRecord' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/Slack/SlackRecord.php',
    'Monolog\\Handler\\SlackbotHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/SlackbotHandler.php',
    'Monolog\\Handler\\SocketHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/SocketHandler.php',
    'Monolog\\Handler\\StreamHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/StreamHandler.php',
    'Monolog\\Handler\\SwiftMailerHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/SwiftMailerHandler.php',
    'Monolog\\Handler\\SyslogHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/SyslogHandler.php',
    'Monolog\\Handler\\SyslogUdpHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/SyslogUdpHandler.php',
    'Monolog\\Handler\\SyslogUdp\\UdpSocket' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/SyslogUdp/UdpSocket.php',
    'Monolog\\Handler\\TestHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/TestHandler.php',
    'Monolog\\Handler\\WhatFailureGroupHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/WhatFailureGroupHandler.php',
    'Monolog\\Handler\\ZendMonitorHandler' => $vendorDir . '/monolog/monolog/src/Monolog/Handler/ZendMonitorHandler.php',
    'Monolog\\Logger' => $vendorDir . '/monolog/monolog/src/Monolog/Logger.php',
    'Monolog\\Processor\\GitProcessor' => $vendorDir . '/monolog/monolog/src/Monolog/Processor/GitProcessor.php',
    'Monolog\\Processor\\IntrospectionProcessor' => $vendorDir . '/monolog/monolog/src/Monolog/Processor/IntrospectionProcessor.php',
    'Monolog\\Processor\\MemoryPeakUsageProcessor' => $vendorDir . '/monolog/monolog/src/Monolog/Processor/MemoryPeakUsageProcessor.php',
    'Monolog\\Processor\\MemoryProcessor' => $vendorDir . '/monolog/monolog/src/Monolog/Processor/MemoryProcessor.php',
    'Monolog\\Processor\\MemoryUsageProcessor' => $vendorDir . '/monolog/monolog/src/Monolog/Processor/MemoryUsageProcessor.php',
    'Monolog\\Processor\\MercurialProcessor' => $vendorDir . '/monolog/monolog/src/Monolog/Processor/MercurialProcessor.php',
    'Monolog\\Processor\\ProcessIdProcessor' => $vendorDir . '/monolog/monolog/src/Monolog/Processor/ProcessIdProcessor.php',
    'Monolog\\Processor\\ProcessorInterface' => $vendorDir . '/monolog/monolog/src/Monolog/Processor/ProcessorInterface.php',
    'Monolog\\Processor\\PsrLogMessageProcessor' => $vendorDir . '/monolog/monolog/src/Monolog/Processor/PsrLogMessageProcessor.php',
    'Monolog\\Processor\\TagProcessor' => $vendorDir . '/monolog/monolog/src/Monolog/Processor/TagProcessor.php',
    'Monolog\\Processor\\UidProcessor' => $vendorDir . '/monolog/monolog/src/Monolog/Processor/UidProcessor.php',
    'Monolog\\Processor\\WebProcessor' => $vendorDir . '/monolog/monolog/src/Monolog/Processor/WebProcessor.php',
    'Monolog\\Registry' => $vendorDir . '/monolog/monolog/src/Monolog/Registry.php',
    'Monolog\\ResettableInterface' => $vendorDir . '/monolog/monolog/src/Monolog/ResettableInterface.php',
    'Monolog\\SignalHandler' => $vendorDir . '/monolog/monolog/src/Monolog/SignalHandler.php',
    'Monolog\\Utils' => $vendorDir . '/monolog/monolog/src/Monolog/Utils.php',
    'MySQLHandler\\MySQLHandler' => $vendorDir . '/wazaari/monolog-mysql/src/MySQLHandler/MySQLHandler.php',
    'Psr\\Log\\AbstractLogger' => $vendorDir . '/psr/log/Psr/Log/AbstractLogger.php',
    'Psr\\Log\\InvalidArgumentException' => $vendorDir . '/psr/log/Psr/Log/InvalidArgumentException.php',
    'Psr\\Log\\LogLevel' => $vendorDir . '/psr/log/Psr/Log/LogLevel.php',
    'Psr\\Log\\LoggerAwareInterface' => $vendorDir . '/psr/log/Psr/Log/LoggerAwareInterface.php',
    'Psr\\Log\\LoggerAwareTrait' => $vendorDir . '/psr/log/Psr/Log/LoggerAwareTrait.php',
    'Psr\\Log\\LoggerInterface' => $vendorDir . '/psr/log/Psr/Log/LoggerInterface.php',
    'Psr\\Log\\LoggerTrait' => $vendorDir . '/psr/log/Psr/Log/LoggerTrait.php',
    'Psr\\Log\\NullLogger' => $vendorDir . '/psr/log/Psr/Log/NullLogger.php',
    'Psr\\Log\\Test\\DummyTest' => $vendorDir . '/psr/log/Psr/Log/Test/LoggerInterfaceTest.php',
    'Psr\\Log\\Test\\LoggerInterfaceTest' => $vendorDir . '/psr/log/Psr/Log/Test/LoggerInterfaceTest.php',
    'Psr\\Log\\Test\\TestLogger' => $vendorDir . '/psr/log/Psr/Log/Test/TestLogger.php',
    'Whoops\\Exception\\ErrorException' => $vendorDir . '/filp/whoops/src/Whoops/Exception/ErrorException.php',
    'Whoops\\Exception\\Formatter' => $vendorDir . '/filp/whoops/src/Whoops/Exception/Formatter.php',
    'Whoops\\Exception\\Frame' => $vendorDir . '/filp/whoops/src/Whoops/Exception/Frame.php',
    'Whoops\\Exception\\FrameCollection' => $vendorDir . '/filp/whoops/src/Whoops/Exception/FrameCollection.php',
    'Whoops\\Exception\\Inspector' => $vendorDir . '/filp/whoops/src/Whoops/Exception/Inspector.php',
    'Whoops\\Handler\\CallbackHandler' => $vendorDir . '/filp/whoops/src/Whoops/Handler/CallbackHandler.php',
    'Whoops\\Handler\\Handler' => $vendorDir . '/filp/whoops/src/Whoops/Handler/Handler.php',
    'Whoops\\Handler\\HandlerInterface' => $vendorDir . '/filp/whoops/src/Whoops/Handler/HandlerInterface.php',
    'Whoops\\Handler\\JsonResponseHandler' => $vendorDir . '/filp/whoops/src/Whoops/Handler/JsonResponseHandler.php',
    'Whoops\\Handler\\PlainTextHandler' => $vendorDir . '/filp/whoops/src/Whoops/Handler/PlainTextHandler.php',
    'Whoops\\Handler\\PrettyPageHandler' => $vendorDir . '/filp/whoops/src/Whoops/Handler/PrettyPageHandler.php',
    'Whoops\\Handler\\XmlResponseHandler' => $vendorDir . '/filp/whoops/src/Whoops/Handler/XmlResponseHandler.php',
    'Whoops\\Run' => $vendorDir . '/filp/whoops/src/Whoops/Run.php',
    'Whoops\\RunInterface' => $vendorDir . '/filp/whoops/src/Whoops/RunInterface.php',
    'Whoops\\Util\\HtmlDumperOutput' => $vendorDir . '/filp/whoops/src/Whoops/Util/HtmlDumperOutput.php',
    'Whoops\\Util\\Misc' => $vendorDir . '/filp/whoops/src/Whoops/Util/Misc.php',
    'Whoops\\Util\\SystemFacade' => $vendorDir . '/filp/whoops/src/Whoops/Util/SystemFacade.php',
    'Whoops\\Util\\TemplateHelper' => $vendorDir . '/filp/whoops/src/Whoops/Util/TemplateHelper.php',
);
