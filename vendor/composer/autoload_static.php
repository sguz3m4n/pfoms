<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdbfd59ea50047003c0635f21387c380a
{
    public static $files = array (
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Whoops\\' => 7,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'MySQLHandler\\' => 13,
            'Monolog\\' => 8,
        ),
        'F' => 
        array (
            'FastRoute\\' => 10,
        ),
        'C' => 
        array (
            'Controllers\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Whoops\\' => 
        array (
            0 => __DIR__ . '/..' . '/filp/whoops/src/Whoops',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'MySQLHandler\\' => 
        array (
            0 => __DIR__ . '/..' . '/wazaari/monolog-mysql/src/MySQLHandler',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Controller',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/../pfoms',
    );

    public static $prefixesPsr0 = array (
        'J' => 
        array (
            'Jaspersoft' => 
            array (
                0 => __DIR__ . '/..' . '/jaspersoft/rest-client/src',
            ),
        ),
    );

    public static $classMap = array (
        'Controllers\\AccountCreateController' => __DIR__ . '/../..' . '/Controller/Account/Create.php',
        'Controllers\\AccountDeactivateController' => __DIR__ . '/../..' . '/Controller/Account/Delete.php',
        'Controllers\\AccountEditController' => __DIR__ . '/../..' . '/Controller/Account/Edit.php',
        'Controllers\\AmendPaymentController' => __DIR__ . '/../..' . '/Controller/Payment/Amend.php',
        'Controllers\\ApproveCreateController' => __DIR__ . '/../..' . '/Controller/Approve/Create.php',
        'Controllers\\BaseController' => __DIR__ . '/../..' . '/Controller/base_template.php',
        'Controllers\\BaseTemplate' => __DIR__ . '/../..' . '/Controller/base_template.php',
        'Controllers\\CompanyCreateController' => __DIR__ . '/../..' . '/Controller/Company/Create.php',
        'Controllers\\CompanyDeactivateController' => __DIR__ . '/../..' . '/Controller/Company/Delete.php',
        'Controllers\\CompanyEditController' => __DIR__ . '/../..' . '/Controller/Company/Edit.php',
        'Controllers\\ConfigCreateController' => __DIR__ . '/../..' . '/Controller/Config/Create.php',
        'Controllers\\ConfigDeactivateController' => __DIR__ . '/../..' . '/Controller/Config/Delete.php',
        'Controllers\\ConfigEditController' => __DIR__ . '/../..' . '/Controller/Config/Edit.php',
        'Controllers\\ConsoleController' => __DIR__ . '/../..' . '/Controller/Admin/ConsoleManager.php',
        'Controllers\\CreateAdminUserController' => __DIR__ . '/../..' . '/Controller/Admin/CreateUser.php',
        'Controllers\\CreateDutySheetController' => __DIR__ . '/../..' . '/Controller/DutySheet/Create.php',
        'Controllers\\DisburseController' => __DIR__ . '/../..' . '/Controller/PRNGen/PRNGenerate.php',
        'Controllers\\DutySheetTableController' => __DIR__ . '/../..' . '/Controller/DutySheet/dutysheettable.php',
        'Controllers\\EditAdminUserController' => __DIR__ . '/../..' . '/Controller/Admin/EditUser.php',
        'Controllers\\EditDutySheetController' => __DIR__ . '/../..' . '/Controller/DutySheet/Edit.php',
        'Controllers\\EditPRNController' => __DIR__ . '/../..' . '/Controller/PRNGen/PRNGenerate.php',
        'Controllers\\EditPaymentController' => __DIR__ . '/../..' . '/Controller/Payment/Edit.php',
        'Controllers\\EmployeeCreateController' => __DIR__ . '/../..' . '/Controller/Employee/Create.php',
        'Controllers\\EmployeeDeactivateController' => __DIR__ . '/../..' . '/Controller/Employee/Delete.php',
        'Controllers\\EmployeeEditController' => __DIR__ . '/../..' . '/Controller/Employee/Edit.php',
        'Controllers\\EquipmentCreateController' => __DIR__ . '/../..' . '/Controller/Equipment/Create.php',
        'Controllers\\EquipmentDeactivateController' => __DIR__ . '/../..' . '/Controller/Equipment/Delete.php',
        'Controllers\\EquipmentEditController' => __DIR__ . '/../..' . '/Controller/Equipment/Edit.php',
        'Controllers\\Error' => __DIR__ . '/../..' . '/Controller/ErrorController.php',
        'Controllers\\EventCreateController' => __DIR__ . '/../..' . '/Controller/Event/Create.php',
        'Controllers\\EventDeactivateController' => __DIR__ . '/../..' . '/Controller/Event/Delete.php',
        'Controllers\\EventEditController' => __DIR__ . '/../..' . '/Controller/Event/Edit.php',
        'Controllers\\Homepage' => __DIR__ . '/../..' . '/Controller/HomepageController.php',
        'Controllers\\LoggedInController' => __DIR__ . '/../..' . '/Controller/base_template.php',
        'Controllers\\Login' => __DIR__ . '/../..' . '/Controller/LoginController.php',
        'Controllers\\MakeDepositController' => __DIR__ . '/../..' . '/Controller/Deposit/Create.php',
        'Controllers\\MakePaymentController' => __DIR__ . '/../..' . '/Controller/Payment/Create.php',
        'Controllers\\MakeProformaController' => __DIR__ . '/../..' . '/Controller/Event/MakeProforma.php',
        'Controllers\\MakeRefundController' => __DIR__ . '/../..' . '/Controller/Refund/Create.php',
        'Controllers\\ManagePOTController' => __DIR__ . '/../..' . '/Controller/Admin/ManagePOT.php',
        'Controllers\\ManagersReportController' => __DIR__ . '/../..' . '/Controller/Reports/ReportController.php',
        'Controllers\\MasterTemplate' => __DIR__ . '/../..' . '/Controller/base_template.php',
        'Controllers\\OfficerPaymentController' => __DIR__ . '/../..' . '/Controller/Payment/Create.php',
        'Controllers\\PRNTableController' => __DIR__ . '/../..' . '/Controller/PRNGen/PRNGenerate.php',
        'Controllers\\PRNUnlockController' => __DIR__ . '/../..' . '/Controller/PRNGen/PRNGenerate.php',
        'Controllers\\PasswordController' => __DIR__ . '/../..' . '/Controller/PasswordController.php',
        'Controllers\\PaymentTableController' => __DIR__ . '/../..' . '/Controller/Payment/Edit.php',
        'Controllers\\PaymentUnlockController' => __DIR__ . '/../..' . '/Controller/Payment/Edit.php',
        'Controllers\\PaymentsReportController' => __DIR__ . '/../..' . '/Controller/Reports/PaymentsReportController.php',
        'Controllers\\PayrollController' => __DIR__ . '/../..' . '/Controller/Payroll/Process.php',
        'Controllers\\PermissionController' => __DIR__ . '/../..' . '/Controller/base_template.php',
        'Controllers\\ReportController' => __DIR__ . '/../..' . '/Controller/Reports/ReportController_old.php',
        'Controllers\\StationCreateController' => __DIR__ . '/../..' . '/Controller/Station/Create.php',
        'Controllers\\StationEditController' => __DIR__ . '/../..' . '/Controller/Station/Edit.php',
        'Controllers\\SuccessController' => __DIR__ . '/../..' . '/Controller/Success/Show.php',
        'Controllers\\WorkflowCreateController' => __DIR__ . '/../..' . '/Controller/Workflow/Create.php',
        'Controllers\\WorkflowEditController' => __DIR__ . '/../..' . '/Controller/Workflow/Edit.php',
        'FastRoute\\BadRouteException' => __DIR__ . '/..' . '/nikic/fast-route/src/BadRouteException.php',
        'FastRoute\\DataGenerator' => __DIR__ . '/..' . '/nikic/fast-route/src/DataGenerator.php',
        'FastRoute\\DataGenerator\\CharCountBased' => __DIR__ . '/..' . '/nikic/fast-route/src/DataGenerator/CharCountBased.php',
        'FastRoute\\DataGenerator\\GroupCountBased' => __DIR__ . '/..' . '/nikic/fast-route/src/DataGenerator/GroupCountBased.php',
        'FastRoute\\DataGenerator\\GroupPosBased' => __DIR__ . '/..' . '/nikic/fast-route/src/DataGenerator/GroupPosBased.php',
        'FastRoute\\DataGenerator\\MarkBased' => __DIR__ . '/..' . '/nikic/fast-route/src/DataGenerator/MarkBased.php',
        'FastRoute\\DataGenerator\\RegexBasedAbstract' => __DIR__ . '/..' . '/nikic/fast-route/src/DataGenerator/RegexBasedAbstract.php',
        'FastRoute\\Dispatcher' => __DIR__ . '/..' . '/nikic/fast-route/src/Dispatcher.php',
        'FastRoute\\Dispatcher\\CharCountBased' => __DIR__ . '/..' . '/nikic/fast-route/src/Dispatcher/CharCountBased.php',
        'FastRoute\\Dispatcher\\GroupCountBased' => __DIR__ . '/..' . '/nikic/fast-route/src/Dispatcher/GroupCountBased.php',
        'FastRoute\\Dispatcher\\GroupPosBased' => __DIR__ . '/..' . '/nikic/fast-route/src/Dispatcher/GroupPosBased.php',
        'FastRoute\\Dispatcher\\MarkBased' => __DIR__ . '/..' . '/nikic/fast-route/src/Dispatcher/MarkBased.php',
        'FastRoute\\Dispatcher\\RegexBasedAbstract' => __DIR__ . '/..' . '/nikic/fast-route/src/Dispatcher/RegexBasedAbstract.php',
        'FastRoute\\Route' => __DIR__ . '/..' . '/nikic/fast-route/src/Route.php',
        'FastRoute\\RouteCollector' => __DIR__ . '/..' . '/nikic/fast-route/src/RouteCollector.php',
        'FastRoute\\RouteParser' => __DIR__ . '/..' . '/nikic/fast-route/src/RouteParser.php',
        'FastRoute\\RouteParser\\Std' => __DIR__ . '/..' . '/nikic/fast-route/src/RouteParser/Std.php',
        'Jaspersoft\\Client\\Client' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Client/Client.php',
        'Jaspersoft\\Dto\\Attribute\\Attribute' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Attribute/Attribute.php',
        'Jaspersoft\\Dto\\ImportExport\\ExportTask' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/ImportExport/ExportTask.php',
        'Jaspersoft\\Dto\\ImportExport\\ImportTask' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/ImportExport/ImportTask.php',
        'Jaspersoft\\Dto\\ImportExport\\TaskState' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/ImportExport/TaskState.php',
        'Jaspersoft\\Dto\\Job\\Alert' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/Alert.php',
        'Jaspersoft\\Dto\\Job\\CalendarTrigger' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/CalendarTrigger.php',
        'Jaspersoft\\Dto\\Job\\Job' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/Job.php',
        'Jaspersoft\\Dto\\Job\\JobState' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/JobState.php',
        'Jaspersoft\\Dto\\Job\\JobSummary' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/JobSummary.php',
        'Jaspersoft\\Dto\\Job\\MailNotification' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/MailNotification.php',
        'Jaspersoft\\Dto\\Job\\OutputFTPInfo' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/OutputFTPInfo.php',
        'Jaspersoft\\Dto\\Job\\RepositoryDestination' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/RepositoryDestination.php',
        'Jaspersoft\\Dto\\Job\\SimpleTrigger' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/SimpleTrigger.php',
        'Jaspersoft\\Dto\\Job\\Source' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/Source.php',
        'Jaspersoft\\Dto\\Job\\Trigger' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Job/Trigger.php',
        'Jaspersoft\\Dto\\Options\\ReportOptions' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Options/ReportOptions.php',
        'Jaspersoft\\Dto\\Organization\\Organization' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Organization/Organization.php',
        'Jaspersoft\\Dto\\Permission\\RepositoryPermission' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Permission/RepositoryPermission.php',
        'Jaspersoft\\Dto\\ReportExecution\\Execution' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/ReportExecution/Execution.php',
        'Jaspersoft\\Dto\\ReportExecution\\ExecutionRequest' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/ReportExecution/ExecutionRequest.php',
        'Jaspersoft\\Dto\\Report\\InputControl' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Report/InputControl.php',
        'Jaspersoft\\Dto\\Resource\\AdhocDataView' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/AdhocDataView.php',
        'Jaspersoft\\Dto\\Resource\\AwsDataSource' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/AwsDataSource.php',
        'Jaspersoft\\Dto\\Resource\\BeanDataSource' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/BeanDataSource.php',
        'Jaspersoft\\Dto\\Resource\\CollectiveResource' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/CollectiveResource.php',
        'Jaspersoft\\Dto\\Resource\\CompositeResource' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/CompositeResource.php',
        'Jaspersoft\\Dto\\Resource\\CustomDataSource' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/CustomDataSource.php',
        'Jaspersoft\\Dto\\Resource\\Dashboard' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/Dashboard.php',
        'Jaspersoft\\Dto\\Resource\\DataType' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/DataType.php',
        'Jaspersoft\\Dto\\Resource\\DomainTopic' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/DomainTopic.php',
        'Jaspersoft\\Dto\\Resource\\File' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/File.php',
        'Jaspersoft\\Dto\\Resource\\Folder' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/Folder.php',
        'Jaspersoft\\Dto\\Resource\\InputControl' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/InputControl.php',
        'Jaspersoft\\Dto\\Resource\\JdbcDataSource' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/JdbcDataSource.php',
        'Jaspersoft\\Dto\\Resource\\JndiJdbcDataSource' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/JndiJdbcDataSource.php',
        'Jaspersoft\\Dto\\Resource\\ListOfValues' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/ListOfValues.php',
        'Jaspersoft\\Dto\\Resource\\MondrianConnection' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/MondrianConnection.php',
        'Jaspersoft\\Dto\\Resource\\MondrianXmlaDefinition' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/MondrianXmlaDefinition.php',
        'Jaspersoft\\Dto\\Resource\\OlapUnit' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/OlapUnit.php',
        'Jaspersoft\\Dto\\Resource\\Query' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/Query.php',
        'Jaspersoft\\Dto\\Resource\\ReportOptions' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/ReportOptions.php',
        'Jaspersoft\\Dto\\Resource\\ReportUnit' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/ReportUnit.php',
        'Jaspersoft\\Dto\\Resource\\Resource' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/Resource.php',
        'Jaspersoft\\Dto\\Resource\\ResourceLookup' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/ResourceLookup.php',
        'Jaspersoft\\Dto\\Resource\\SecureMondrianConnection' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/SecureMondrianConnection.php',
        'Jaspersoft\\Dto\\Resource\\SemanticLayerDataSource' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/SemanticLayerDataSource.php',
        'Jaspersoft\\Dto\\Resource\\VirtualDataSource' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/VirtualDataSource.php',
        'Jaspersoft\\Dto\\Resource\\XmlaConnection' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Resource/XmlaConnection.php',
        'Jaspersoft\\Dto\\Role\\Role' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/Role/Role.php',
        'Jaspersoft\\Dto\\User\\User' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/User/User.php',
        'Jaspersoft\\Dto\\User\\UserLookup' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Dto/User/UserLookup.php',
        'Jaspersoft\\Exception\\RESTRequestException' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Exception/RESTRequestException.php',
        'Jaspersoft\\Exception\\ResourceServiceException' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Exception/ResourceServiceException.php',
        'Jaspersoft\\Service\\Criteria\\Criterion' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Service/Criteria/Criterion.php',
        'Jaspersoft\\Service\\Criteria\\RepositorySearchCriteria' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Service/Criteria/RepositorySearchCriteria.php',
        'Jaspersoft\\Service\\ImportExportService' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Service/ImportExportService.php',
        'Jaspersoft\\Service\\JobService' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Service/JobService.php',
        'Jaspersoft\\Service\\OptionsService' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Service/OptionsService.php',
        'Jaspersoft\\Service\\OrganizationService' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Service/OrganizationService.php',
        'Jaspersoft\\Service\\PermissionService' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Service/PermissionService.php',
        'Jaspersoft\\Service\\QueryService' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Service/QueryService.php',
        'Jaspersoft\\Service\\ReportService' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Service/ReportService.php',
        'Jaspersoft\\Service\\RepositoryService' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Service/RepositoryService.php',
        'Jaspersoft\\Service\\Result\\SearchResourcesResult' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Service/Result/SearchResourcesResult.php',
        'Jaspersoft\\Service\\RoleService' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Service/RoleService.php',
        'Jaspersoft\\Service\\UserService' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Service/UserService.php',
        'Jaspersoft\\Tool\\CompositeDTOMapper' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Tool/CompositeDTOMapper.php',
        'Jaspersoft\\Tool\\DTOMapper' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Tool/DTOMapper.php',
        'Jaspersoft\\Tool\\MimeMapper' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Tool/MimeMapper.php',
        'Jaspersoft\\Tool\\RESTRequest' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Tool/RESTRequest.php',
        'Jaspersoft\\Tool\\TestUtils' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Tool/TestUtils.php',
        'Jaspersoft\\Tool\\Util' => __DIR__ . '/..' . '/jaspersoft/rest-client/src/Jaspersoft/Tool/Util.php',
        'Monolog\\ErrorHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/ErrorHandler.php',
        'Monolog\\Formatter\\ChromePHPFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/ChromePHPFormatter.php',
        'Monolog\\Formatter\\ElasticaFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/ElasticaFormatter.php',
        'Monolog\\Formatter\\FlowdockFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/FlowdockFormatter.php',
        'Monolog\\Formatter\\FluentdFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/FluentdFormatter.php',
        'Monolog\\Formatter\\FormatterInterface' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/FormatterInterface.php',
        'Monolog\\Formatter\\GelfMessageFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/GelfMessageFormatter.php',
        'Monolog\\Formatter\\HtmlFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/HtmlFormatter.php',
        'Monolog\\Formatter\\JsonFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/JsonFormatter.php',
        'Monolog\\Formatter\\LineFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/LineFormatter.php',
        'Monolog\\Formatter\\LogglyFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/LogglyFormatter.php',
        'Monolog\\Formatter\\LogstashFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/LogstashFormatter.php',
        'Monolog\\Formatter\\MongoDBFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/MongoDBFormatter.php',
        'Monolog\\Formatter\\NormalizerFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/NormalizerFormatter.php',
        'Monolog\\Formatter\\ScalarFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/ScalarFormatter.php',
        'Monolog\\Formatter\\WildfireFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/WildfireFormatter.php',
        'Monolog\\Handler\\AbstractHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/AbstractHandler.php',
        'Monolog\\Handler\\AbstractProcessingHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/AbstractProcessingHandler.php',
        'Monolog\\Handler\\AbstractSyslogHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/AbstractSyslogHandler.php',
        'Monolog\\Handler\\AmqpHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/AmqpHandler.php',
        'Monolog\\Handler\\BrowserConsoleHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/BrowserConsoleHandler.php',
        'Monolog\\Handler\\BufferHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/BufferHandler.php',
        'Monolog\\Handler\\ChromePHPHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/ChromePHPHandler.php',
        'Monolog\\Handler\\CouchDBHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/CouchDBHandler.php',
        'Monolog\\Handler\\CubeHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/CubeHandler.php',
        'Monolog\\Handler\\Curl\\Util' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/Curl/Util.php',
        'Monolog\\Handler\\DeduplicationHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/DeduplicationHandler.php',
        'Monolog\\Handler\\DoctrineCouchDBHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/DoctrineCouchDBHandler.php',
        'Monolog\\Handler\\DynamoDbHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/DynamoDbHandler.php',
        'Monolog\\Handler\\ElasticSearchHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/ElasticSearchHandler.php',
        'Monolog\\Handler\\ErrorLogHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/ErrorLogHandler.php',
        'Monolog\\Handler\\FilterHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FilterHandler.php',
        'Monolog\\Handler\\FingersCrossedHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FingersCrossedHandler.php',
        'Monolog\\Handler\\FingersCrossed\\ActivationStrategyInterface' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FingersCrossed/ActivationStrategyInterface.php',
        'Monolog\\Handler\\FingersCrossed\\ChannelLevelActivationStrategy' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FingersCrossed/ChannelLevelActivationStrategy.php',
        'Monolog\\Handler\\FingersCrossed\\ErrorLevelActivationStrategy' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FingersCrossed/ErrorLevelActivationStrategy.php',
        'Monolog\\Handler\\FirePHPHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FirePHPHandler.php',
        'Monolog\\Handler\\FleepHookHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FleepHookHandler.php',
        'Monolog\\Handler\\FlowdockHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FlowdockHandler.php',
        'Monolog\\Handler\\GelfHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/GelfHandler.php',
        'Monolog\\Handler\\GroupHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/GroupHandler.php',
        'Monolog\\Handler\\HandlerInterface' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/HandlerInterface.php',
        'Monolog\\Handler\\HandlerWrapper' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/HandlerWrapper.php',
        'Monolog\\Handler\\HipChatHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/HipChatHandler.php',
        'Monolog\\Handler\\IFTTTHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/IFTTTHandler.php',
        'Monolog\\Handler\\InsightOpsHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/InsightOpsHandler.php',
        'Monolog\\Handler\\LogEntriesHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/LogEntriesHandler.php',
        'Monolog\\Handler\\LogglyHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/LogglyHandler.php',
        'Monolog\\Handler\\MailHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/MailHandler.php',
        'Monolog\\Handler\\MandrillHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/MandrillHandler.php',
        'Monolog\\Handler\\MissingExtensionException' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/MissingExtensionException.php',
        'Monolog\\Handler\\MongoDBHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/MongoDBHandler.php',
        'Monolog\\Handler\\NativeMailerHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/NativeMailerHandler.php',
        'Monolog\\Handler\\NewRelicHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/NewRelicHandler.php',
        'Monolog\\Handler\\NullHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/NullHandler.php',
        'Monolog\\Handler\\PHPConsoleHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/PHPConsoleHandler.php',
        'Monolog\\Handler\\PsrHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/PsrHandler.php',
        'Monolog\\Handler\\PushoverHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/PushoverHandler.php',
        'Monolog\\Handler\\RavenHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/RavenHandler.php',
        'Monolog\\Handler\\RedisHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/RedisHandler.php',
        'Monolog\\Handler\\RollbarHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/RollbarHandler.php',
        'Monolog\\Handler\\RotatingFileHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/RotatingFileHandler.php',
        'Monolog\\Handler\\SamplingHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SamplingHandler.php',
        'Monolog\\Handler\\SlackHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SlackHandler.php',
        'Monolog\\Handler\\SlackWebhookHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SlackWebhookHandler.php',
        'Monolog\\Handler\\Slack\\SlackRecord' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/Slack/SlackRecord.php',
        'Monolog\\Handler\\SlackbotHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SlackbotHandler.php',
        'Monolog\\Handler\\SocketHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SocketHandler.php',
        'Monolog\\Handler\\StreamHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/StreamHandler.php',
        'Monolog\\Handler\\SwiftMailerHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SwiftMailerHandler.php',
        'Monolog\\Handler\\SyslogHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SyslogHandler.php',
        'Monolog\\Handler\\SyslogUdpHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SyslogUdpHandler.php',
        'Monolog\\Handler\\SyslogUdp\\UdpSocket' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SyslogUdp/UdpSocket.php',
        'Monolog\\Handler\\TestHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/TestHandler.php',
        'Monolog\\Handler\\WhatFailureGroupHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/WhatFailureGroupHandler.php',
        'Monolog\\Handler\\ZendMonitorHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/ZendMonitorHandler.php',
        'Monolog\\Logger' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Logger.php',
        'Monolog\\Processor\\GitProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/GitProcessor.php',
        'Monolog\\Processor\\IntrospectionProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/IntrospectionProcessor.php',
        'Monolog\\Processor\\MemoryPeakUsageProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/MemoryPeakUsageProcessor.php',
        'Monolog\\Processor\\MemoryProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/MemoryProcessor.php',
        'Monolog\\Processor\\MemoryUsageProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/MemoryUsageProcessor.php',
        'Monolog\\Processor\\MercurialProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/MercurialProcessor.php',
        'Monolog\\Processor\\ProcessIdProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/ProcessIdProcessor.php',
        'Monolog\\Processor\\ProcessorInterface' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/ProcessorInterface.php',
        'Monolog\\Processor\\PsrLogMessageProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/PsrLogMessageProcessor.php',
        'Monolog\\Processor\\TagProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/TagProcessor.php',
        'Monolog\\Processor\\UidProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/UidProcessor.php',
        'Monolog\\Processor\\WebProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/WebProcessor.php',
        'Monolog\\Registry' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Registry.php',
        'Monolog\\ResettableInterface' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/ResettableInterface.php',
        'Monolog\\SignalHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/SignalHandler.php',
        'Monolog\\Utils' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Utils.php',
        'MySQLHandler\\MySQLHandler' => __DIR__ . '/..' . '/wazaari/monolog-mysql/src/MySQLHandler/MySQLHandler.php',
        'Psr\\Log\\AbstractLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/AbstractLogger.php',
        'Psr\\Log\\InvalidArgumentException' => __DIR__ . '/..' . '/psr/log/Psr/Log/InvalidArgumentException.php',
        'Psr\\Log\\LogLevel' => __DIR__ . '/..' . '/psr/log/Psr/Log/LogLevel.php',
        'Psr\\Log\\LoggerAwareInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareInterface.php',
        'Psr\\Log\\LoggerAwareTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareTrait.php',
        'Psr\\Log\\LoggerInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerInterface.php',
        'Psr\\Log\\LoggerTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerTrait.php',
        'Psr\\Log\\NullLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/NullLogger.php',
        'Psr\\Log\\Test\\DummyTest' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/LoggerInterfaceTest.php',
        'Psr\\Log\\Test\\LoggerInterfaceTest' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/LoggerInterfaceTest.php',
        'Psr\\Log\\Test\\TestLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/TestLogger.php',
        'Whoops\\Exception\\ErrorException' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Exception/ErrorException.php',
        'Whoops\\Exception\\Formatter' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Exception/Formatter.php',
        'Whoops\\Exception\\Frame' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Exception/Frame.php',
        'Whoops\\Exception\\FrameCollection' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Exception/FrameCollection.php',
        'Whoops\\Exception\\Inspector' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Exception/Inspector.php',
        'Whoops\\Handler\\CallbackHandler' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Handler/CallbackHandler.php',
        'Whoops\\Handler\\Handler' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Handler/Handler.php',
        'Whoops\\Handler\\HandlerInterface' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Handler/HandlerInterface.php',
        'Whoops\\Handler\\JsonResponseHandler' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Handler/JsonResponseHandler.php',
        'Whoops\\Handler\\PlainTextHandler' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Handler/PlainTextHandler.php',
        'Whoops\\Handler\\PrettyPageHandler' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Handler/PrettyPageHandler.php',
        'Whoops\\Handler\\XmlResponseHandler' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Handler/XmlResponseHandler.php',
        'Whoops\\Run' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Run.php',
        'Whoops\\RunInterface' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/RunInterface.php',
        'Whoops\\Util\\HtmlDumperOutput' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Util/HtmlDumperOutput.php',
        'Whoops\\Util\\Misc' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Util/Misc.php',
        'Whoops\\Util\\SystemFacade' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Util/SystemFacade.php',
        'Whoops\\Util\\TemplateHelper' => __DIR__ . '/..' . '/filp/whoops/src/Whoops/Util/TemplateHelper.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdbfd59ea50047003c0635f21387c380a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdbfd59ea50047003c0635f21387c380a::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInitdbfd59ea50047003c0635f21387c380a::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitdbfd59ea50047003c0635f21387c380a::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitdbfd59ea50047003c0635f21387c380a::$classMap;

        }, null, ClassLoader::class);
    }
}
