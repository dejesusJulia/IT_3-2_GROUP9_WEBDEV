# DOCUMENTATION of WEB DEV PROJECT

## Brief Description
This project is originally created for a school requirement for the subject Web Development.

## File Structure
This project uses the Model-View-Controller (MVC) pattern which is a common structure on web development frameworks such as Laravel. The structure of this project is inspired from the YouTube videos of Code with Dary and Codeholic (creating PHP framework from Scratch), and then modified for the needs of the projects. (*Note: All the files are redirected to public/index.php through .htaccess files*)

Design-wise, this system used a Bootstrap template for the admin panel while the design for the users panel is a modified design from the YouTube channel Bedimcode.

### Directory
The root folder has two main subfolders - *app* and *public*. All the controls for the application are in the app directory, while the public directory is where all the files are redirected to.

**APP**
*config* directory contains the *config.php*, which looks lke this:

```
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'password (If there is one)');
define('DB_NAME', 'databasename');

define('APPROOT', dirname(dirname(__FILE__)));

define('URLROOT', '/rootfolder');

define('SITENAME', 'App name');
```
*libraries* directory contains all the classes necessary for loading the application.
*Database.php* - connects the app to the database.
*Model.php* - has access to the database and has queries that may apply to all tables.
*Controller.php* - has access to the main model class and helper classes. 
*Core.php* - has all the necessary functions for routing

*helpers* directory contains helper classes, such as *Filter.php* and *Auth.php*. Both are used in filtering the input from users.

### Routing
The web routes are found in *public/index.php*. The format is stated below:
```
$core->get('your/preferred/url', 'ControllerName@functionToUse');
```

If you want to submit a POST request to the same page, use:
```
$core->post('same/URL/as/GET', 'ControllerName@functionToUse');
```

If you want to submit a POST request and redirect to another page, use:
```
$core->post('URL/you/want/to/redirect/to', 'ControllerName@functionToUse');
```

### Models
Model are the classes that access the database. This is usually where the query statements are. These classes are found at *app/models* directory For the Model classes to have access to the database, it must extend to *app/libraries/Model.php*
*Note: It is recommended that the name of Model classes to be in SINGULAR form*

### Views
Views are the actual pages seen and accessed by users.

### Controllers
Controllers are the middleman between the views and models. They perform the necessary functions and pass data to the views. Controller classes are found in *app/controllers* directory. These classes extend to *app/libraries/Controller.php*.
*Note: It is recommended that the name of Controller classes to be in PLURAL form*

- To access the model, type in:
```
public function __construct(){
    this->modelName = $this->model('ModelName')
}
```
- To access views, use:
```
$this->views('viewname/without/PHPextenstion', $optionalParameter)
```

----------------------------------------------------------------
## SYSTEM FEATURES
- Text and image posting (USER & ADMIN)
- Post commenting (USER & ADMIN)
- Read posts according to classification/topics/tags (USER & ADMIN)
- CRUD operations on a personal user post (USER & ADMIN)
- Modify personal user profile (USER & ADMIN)
- CRUD operations on the post tags/topics (ADMIN)
- Modify user type/access of a user (ADMIN)
- Delete existing users (ADMIN)

