# DOCUMENTATION of WEB DEV PROJECT  (50% progress)
*Hello groupmates :)*

## Brief Description
This project is created as a school requirement for the subject Web Development

## File Structure
This project uses the Model-View-Controller (MVC) pattern which is a common structure on web development frameworks such as Laravel. The structure of this project is inspired from the YouTube videos of Code with Dary and Codeholic (creating PHP framework from Scratch), and then modified for the needs of the projects. (*Note: All the files are redirected to public/index.php through .htaccess files*)

### Routing
The web routes are found in *public/index.php*. The format is stated below:
`$core->get('your/preferred/url', 'ControllerName@functionToUse');`

If you want to submit a POST request to the same page, use:
`$core->post('same/URL/as/GET', 'ControllerName@functionToUse');`

If you want to submit a POST request and redirect to another page, use:
`$core->post('URL/you/want/to/redirect/to', 'ControllerName@functionToUse');`

### Models
Model are the classes that access the database. This is usually where the query statements are. These classes are found at *app/models* directory For the Model classes to have access to the database, it must extend to *app/core/Model.php*
*Note: It is recommended that the name of Model classes to be in SINGULAR form*

### Views
Views are the actual pages seen and accessed by users.

### Controllers
Controllers are the middleman between the views and models. They perform the necessary functions and pass data to the views. Controller classes are found in *app/controllers* directory. These classes extend to *app/core/Controller.php*.
*Note: It is recommended that the name of Controller classes to be in PLURAL form*

- To access the model, call a constructor and type in `this->modelName = $this->model('ModelName')`
- To access views, use the `$this->views('viewname/without/PHPextenstion', $optionalParameterToPassDataTo)` function.

