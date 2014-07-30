RestPluginTemplate
==================

This is a template extension for the [ILIAS REST Plugin](https://github.com/eqsoft/RESTPlugin).

This extension can be used as a starting point when developing new extensions.

#### Features:
It provides exemplary routes to create, read, update and delete simple "items" (CRUD).

#### Requirements:
Note: If you actually want to make REST calls against the endpoints of this extension, you need to create the following database table.

```sql
CREATE TABLE IF NOT EXISTS `dev_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  `description` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
```

You need to install the [ILIAS REST Plugin](https://github.com/eqsoft/RESTPlugin) first at your ILIAS installation.
Then, as any other extension, you need to copy the folder
"template" to the extensions folder of the plugin (i.e. Rest/RESTController/extensions/template).

Example
<pre><code>curl -X GET http://localhost/restplugin.php//template/items
</code></pre>

#### Notes:
As you might have read in the [tutorial](https://github.com/eqsoft/RESTPlugin/wiki/Extensions), the application
logic is located in the model classes. In this example template, database accesses are realized via the ILIAS db abstraction class in its model. Of course other scenarios
are possible and even more likely, e.g. dealing with ILIAS objects directly instead of accessing single database tables.

It is probably easier at the beginning not to secure the routes under development, but it should be kept in mind, that some kind of access control should be provided at the end (see tutorial).


