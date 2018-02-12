<?php
    require_once("StudentManager.php");
    
    $httpVerb = $_SERVER['REQUEST_METHOD']; // POST, GET, PUT, DELETE
    
    $studentManager = new StudentManager();
    
    switch ($httpVerb)
    {
        case "POST":
            // Create
            if (isset($_POST['name']) && isset($_POST['email']))
            {
                $name = $_POST['name'];
                $email = $_POST['email'];
                echo $studentManager->create($name, $email);
            }
            else
            {
                throw new Exception("Invalid HTTP POST request parameters.");
            }
            break;
            
        case "GET":
            // Read
            header("Content-Type: application/json");
            if (isset($_GET['id'])) // Read (by Id)
            {
                echo $studentManager->readById($_GET['id']);
            }
            else // Read (all)
            {
                echo $studentManager->read();
            }
            break;
            
        case "PUT":
            // Update
            parse_str(file_get_contents("php://input"), $putVars);
            if (isset($putVars['id']) && isset($putVars['name'])
                    && isset($putVars['email']))
            {
                $id     = $putVars['id'];
                $name   = $putVars['name'];
                $email  = $putVars['email'];
                echo $studentManager->update($id, $name, $email);
            }
            else
            {
                throw new Exception("Invalid HTTP PUT request parameters.");
            }
            break;
            
        case "DELETE":
            // Delete
            parse_str(file_get_contents("php://input"), $deleteVars);
            if (isset($deleteVars['id']))
            {
                $id = $deleteVars['id'];
                echo $studentManager->delete($id);
            }
            else
            {
                throw new Exception("Invalid HTTP DELETE request parameters.");
            }
            break;
            
        default:
            throw new Exception("Unsupported HTTP request.");
            break;
    }
?>
