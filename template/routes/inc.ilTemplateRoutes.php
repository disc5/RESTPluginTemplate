<?php
/*
 * Prototypical implementation of some rest endpoints for development
 * and testing.
 */

$app->group('/template', function () use ($app) {

    $app->get('/items', function () use ($app) {
        try {
            $app = \Slim\Slim::getInstance();
            $env = $app->environment();

            $dev_model = new ilTemplateModel();
            $data = $dev_model->getItems();
            $result['status'] = 'success';
            $result['items'] = $data;

            $app->response()->header('Content-Type', 'application/json');
            echo json_encode($result);

        } catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    });


    $app->get('/items/:item_id', function ($item_id) use ($app) {
        try {
            $app = \Slim\Slim::getInstance();
            $env = $app->environment();

            $result = array();
            // $result['usr_id'] = $user_id;
            $dev_model = new ilTemplateModel();
            $data =  $dev_model->getItem($item_id);
            $result['item'] = $data;

            $app->response()->header('Content-Type', 'application/json');
            echo json_encode($result);

        } catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    });

    $app->post('/items', function () use ($app) { // create
        try {
            $app = \Slim\Slim::getInstance();
            $env = $app->environment();

            $name = "";
            $description = "";

            $reqdata = $app->request()->getBody(); // json
            $a_data = json_decode($reqdata, true);
            var_dump($a_data);
            $name = $a_data['name'];
            $description = $a_data['description'];



            $result = array();
            $dev_model = new ilTemplateModel();
            $status = $dev_model->createItem($name, $description);

            //$status = true;

            if ($status == true) {
                $result['status'] = "Item created.";
            }else {
                $result['status'] = "Item could not be created!";
            }

            $app->response()->header('Content-Type', 'application/json');
            echo json_encode($result);

        } catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    });

    $app->put('/items/:item_id', function ($item_id) use ($app){ // update
        try {
            $app = \Slim\Slim::getInstance();
            $env = $app->environment();

            $dev_model = new ilTemplateModel();
            $a_Requests = $app->request->put();
            if (count($a_Requests) == 0) {
                $a_Requests = array();
                $reqdata = $app->request()->getBody(); // json
                $a_data = json_decode($reqdata, true);
                var_dump($a_data);
                $a_Requests['name'] = $a_data['data']['name'];
                $a_Requests['description'] = $a_data['data']['description'];
                //$name = $a_data['name'];
                //$description = $a_data['description'];
            }

            if ($item_id == -1) {
                $item_id = $dev_model->createItem("dummy","dummy");
                echo "Created new Item with id: ".$item_id;
            }

            var_dump($a_Requests);
            foreach ($a_Requests as $key => $value) {
                $dev_model->updateItem($item_id, $key, $value);
            }

            $result = array();
            $result['status'] = 'success';
            $data =  $dev_model->getItem($item_id);
            $result['item'] = $data;
            $app->response()->header('Content-Type', 'application/json');
            echo json_encode($result);

        } catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    });

    $app->delete('/items/:item_id', function ($item_id) use ($app) {
        try {
            $app = \Slim\Slim::getInstance();
            $env = $app->environment();



            $result = array();

            $dev_model = new ilTemplateModel();
            $status = $dev_model->deleteItem($item_id);

            if ($status == true) {
                $result['status'] = "Item ".$item_id." deleted.";
            }else {
                $result['status'] = "Item ".$item_id." not deleted!";
            }

            $app->response()->header('Content-Type', 'application/json');
            echo json_encode($result);

        } catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    });

    $app->delete('/items', function () use ($app) {
        try {
            $app = \Slim\Slim::getInstance();
            $env = $app->environment();

            $request = $app->request();
            $item_id = $request->params('id');


            $result = array();

            $dev_model = new ilTemplateModel();
            $status = $dev_model->deleteItem($item_id);

            if ($status == true) {
                $result['status'] = "Item ".$item_id." deleted.";
            }else {
                $result['status'] = "Item ".$item_id." not deleted!";
            }



        } catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    });

});
?>