<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Directories
    |--------------------------------------------------------------------------
    |
    | The default directory structure
    |
    */

    'repository_directory' => app_path('Repositories/'),
    'interface_directory' => app_path('Repositories/Interfaces/'),
    'model_directory' => app_path('Models/'),

    /*
    |--------------------------------------------------------------------------
    | Namespaces
    |--------------------------------------------------------------------------
    |
    | The namespace of repository, interface and models
    |
    */

    'model_namespace' => 'App\Models',
    'repository_namespace' => 'App\Repositories',
    'interface_namespace' => 'App\Repositories\Interfaces',

    /*
    |--------------------------------------------------------------------------
    | Main Repository File
    |--------------------------------------------------------------------------
    |
    | The main repository class, other repositories will be extended from this
    |
    | If you're working with your customized repository file
    | You should change these values like below,
    |
    | 'main_repository_file' => 'CustomFile.php'
    | 'main_repository_class' => 'App\Custom\Repository:class'
    */

    // Only file name of the file because full path can cause errors.
    // We're gonna use "repository_directory" config value for it.
    'main_repository_file' => 'Repository.php',

    // Class name as string
    'main_repository_class' => \OzanAkman\RepositoryGenerator\Repository::class,

    /*
    |--------------------------------------------------------------------------
    | Main Interface File
    |--------------------------------------------------------------------------
    |
    | The main interface class, other interfaces will be extended from this
    */

    'main_interface_file' => 'RepositoryInterface.php',
    'main_interface_class' => \OzanAkman\RepositoryGenerator\RepositoryInterface::class,

    /*
    |--------------------------------------------------------------------------
    | Active Scope Configuration (Optional)
    |--------------------------------------------------------------------------
    |
    | Similar to Eloquent's scopes but global, E.g. Method::active()->get();
    | The database column which contains integer or bool data to filter.
    | Most projects need it but of course, you don't have to use it
    */

    'active_column' => 'active',

];
