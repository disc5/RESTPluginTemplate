## Template for API Designers and Developers of the ILIAS REST Plugin

This is an extension for the [ILIAS REST Plugin](https://github.com/eqsoft/RESTPlugin)
It shows in which way routes and models can be defined to extend the API
with additional REST endpoints.

A REST Plugin extension consists of a
##### Folder structure
* /ext_name
    - /models
    - /routes

and
#####  Files
* ext_name/README.md - exposes a human readable API explanation (like this file)
* ext_name/routes/route_file.php (name is arbitrary) - contains SLIM route definitions
* ext_name/models/model1.php (name is arbitrary) - is a class that provides functionality needed to accomplish
the routes actions.

There can be multiple models files available and be used within the routes definition file.
The general idea is to keep the route definition ("controller") as short and readable as possible whereas
the more complex application logic ("model") is encapsulated within the model files.


### Features:
* All CRUD operations are implemented examplarily.

### API
>/template/items - GET - delivers all available items in JSON format

>/template/items/id  - GET - delivers the item specified by id in JSON format

>/template/items - POST - creates a new item

>/template/items/id - PUT - modfies an item with the specified id

>/template/idems/id - DELETE - deletes an item with the specified id

### Examples

Example
> ** Retrieve a all items **
curl -X GET http://localhost/restplugin.php/template/items

