<?php
/**
 * https://mrna.ir
 */
 
 use WHMCS\Database\Capsule;
// use WHMCS\Module\Addon\AddonModule\Admin\AdminDispatcher;
// use WHMCS\Module\Addon\AddonModule\Client\ClientDispatcher;

// Create a new table.
// try {
//     Capsule::schema()->create(
//         'my_table',
//         function ($table) {
//             /** @var \Illuminate\Database\Schema\Blueprint $table */
//             $table->increments('id');
//             $table->string('name');
//             $table->integer('serial_number');
//             $table->boolean('is_required');
//             $table->timestamps();
//         }
//     );
// } catch (\Exception $e) {
//     echo "Unable to create my_table: {$e->getMessage()}";
// }

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function support_ticket_config() {
	return array(
    	"name" => "افزونه صفحه اختصاصی ثبت تیکت",
    	"description" => "مدیریت و کنترل صفحه ثبت تیکت",
    	"version" => "0.1",
    	"author" => "<a href='https://mrna.ir'>Mohammad Reza Nasari Asl</a>",
    	"language" => "english"
    );
}

/**
 * Activate.
 *
 * Called upon activation of the module for the first time.
 * Use this function to perform any database and schema modifications
 * required by your module.
 *
 * This function is optional.
 *
 * @see https://developers.whmcs.com/advanced/db-interaction/
 *
 * @return array Optional success/failure message
 */
function support_ticket_activate()
{
    // Create custom tables and schema required by your module
    try {
        Capsule::schema()
            ->create(
                'mrna_support_ticket_article',
                function ($table) {
                    /** @var \Illuminate\Database\Schema\Blueprint $table */
                    $table->increments('id');
                    $table->text('demo');
                }
            );

        return [
            // Supported values here include: success, error or info
            'status' => 'success',
            'description' => 'This is a demo module only. '
                . 'In a real module you might report a success or instruct a '
                    . 'user how to get started with it here.',
        ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            'status' => "error",
            'description' => 'Unable to create mrna_support_ticket_article: ' . $e->getMessage(),
        ];
    }
}

/**
 * Deactivate.
 *
 * Called upon deactivation of the module.
 * Use this function to undo any database and schema modifications
 * performed by your module.
 *
 * This function is optional.
 *
 * @see https://developers.whmcs.com/advanced/db-interaction/
 *
 * @return array Optional success/failure message
 */
/* function support_ticket_deactivate()
{
    // Undo any database and schema modifications made by your module here
    try {
        Capsule::schema()
            ->dropIfExists('mrna_support_ticket_article');

        return [
            // Supported values here include: success, error or info
            'status' => 'success',
            'description' => 'This is a demo module only. '
                . 'In a real module you might report a success here.',
        ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            "status" => "error",
            "description" => "Unable to drop mrna_support_ticket_article: {$e->getMessage()}",
        ];
    }
} */



function support_ticket_output($vars) {

    $modulelink = $vars['modulelink'];
    $version = $vars['version'];
    $option1 = $vars['option1'];
    $option2 = $vars['option2'];
    $option3 = $vars['option3'];
    $option4 = $vars['option4'];
    $option5 = $vars['option5'];
    $option6 = $vars['option6'];
    $LANG = $vars['_lang'];

    echo '<p> صفحه مدیریت افزونه ثبت تیکت ' . date("Y-m-d H:i:s") . '</p>';
	echo "modulelink = ".$modulelink;
        // Perform potentially risky queries in a transaction for easy rollback.

?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="insert-tab" data-toggle="tab" href="#insert" role="tab" aria-controls="insert" aria-selected="true">ثبت مقاله</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="article-tab" data-toggle="tab" href="#article" role="tab" aria-controls="article" aria-selected="false">مرور مقالات</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="insert-tab">...</div>
  <div class="tab-pane fade" id="article" role="tabpanel" aria-labelledby="article-tab">...</div>
</div>

<?php	
  if(isset($_POST["name"]) && !empty($_POST["name"]) ){ 
	try {
            Capsule::connection()->transaction(
                function ($connectionManager)
                {
                    /** @var \Illuminate\Database\Connection $connectionManager */
                    $connectionManager->table('mrna_support_ticket_article')->insert(
                        [
                            'demo' => $_GET['demo']
                        ]
                    );
                }
            );
        } catch (\Exception $e) {
            echo "Uh oh! Inserting didn't work, but I was able to rollback. {$e->getMessage()}";
    }

  }
}

function support_ticket_clientarea($vars) {
 
  include 'clienthome.php';
    $modulelink = $vars['modulelink'];
    $version = $vars['version'];
    $option1 = $vars['option1'];
    $option2 = $vars['option2'];
    $option3 = $vars['option3'];
    $option4 = $vars['option4'];
    $option5 = $vars['option5'];
    $option6 = $vars['option6'];
    $LANG = $vars['_lang'];
 
// create or open (if exists) the database
//$database = new SQLite3('/home/devmaralhost/public_html/modules/addons/mrna_support_ticket_article/fullpath_myDatabase.sqlite');

    return array(
        'pagetitle' => 'ثبت تیکت پشتیبانی',
        'breadcrumb' => array('index.php?m=support_ticket'=>'ثبت تیکت'),
        'templatefile' => 'clienthome',
        'requirelogin' => true, # accepts true/false
        'forcessl' => false, # accepts true/false
        'vars' => array(
            'testvar' => 'demo',
            'anothervar' => 'value',
            'sample' => 'test',
        ),
    );
 
}

// if (!empty($_GET))
// {
// include 'clienthome.php';
// }