<?php
    class StudentManager
    {
        public function create($name, $email)
        {
            $retVal = NULL;
            
            $db = new PDO("mysql:host=localhost;dbname=madison_college", "root", "root");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Create a record in the students table for the given name and email
            $sql = "INSERT INTO students(name, email) VALUES(:name, :email)";
            
            try
            {
                $query = $db->prepare($sql);
                /*
                $query->bindParam(":name", $name);
                $query->bindParam(":email", $email);
                */
                // Alternative syntax to bind parameters and execute query
                $query->execute(array(":name"=>$name, ":email"=>$email));
                
                $retVal = $db->lastInsertId();
            }
            catch (Exception $ex)
            {
                echo "{$ex->getMessage()}<br/>\n";
            }
            
            return $retVal;
        }
        
        public function read()
        {
            $retVal = NULL;
            
            $db = new PDO("mysql:host=localhost;dbname=madison_college", "root", "root");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Read the id, name, email, and create for all records
            $sql = "SELECT id, name, email, created FROM students";
            
            try
            {
                $query = $db->prepare($sql);
                $query->execute();
                
                $results = $query->fetchAll(PDO::FETCH_ASSOC);
                
                $retVal = json_encode($results, JSON_PRETTY_PRINT);
            }
            catch (Exception $ex)
            {
                echo "{$ex->getMessage()}<br/>\n";
            }
            
            return $retVal;
        }
        
        public function readById($id)
        {
            $retVal = NULL;
            
            $db = new PDO("mysql:host=localhost;dbname=madison_college", "root", "root");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Read the id, name, email, and create for all records
            $sql = "SELECT id, name, email, created FROM students WHERE id=:id";
            
            try
            {
                $query = $db->prepare($sql);
                $query->bindParam(":id", $id);
                $query->execute();
                
                $results = $query->fetchAll(PDO::FETCH_ASSOC);
                
                $retVal = json_encode($results, JSON_PRETTY_PRINT);
            }
            catch (Exception $ex)
            {
                echo "{$ex->getMessage()}<br/>\n";
            }
            
            return $retVal;
        }
        
        public function update($id, $name, $email)
        {
            $retVal = NULL;
            
            $db = new PDO("mysql:host=localhost;dbname=madison_college", "root", "root");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Update a record in the students table for the given id with name and email
            $sql = "UPDATE students SET name=:name, email=:email WHERE id=:id";
            
            try
            {
                $query = $db->prepare($sql);
                $query->execute(array(":id"=>$id, ":name"=>$name, ":email"=>$email));
                
                $retVal = $query->rowCount(); // Return the # of rows affected
            }
            catch (Exception $ex)
            {
                echo "{$ex->getMessage()}<br/>\n";
            }
            
            return $retVal;
        }
        
        public function delete($id)
        {
            $retVal = NULL;
            
            $db = new PDO("mysql:host=localhost;dbname=madison_college", "root", "root");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Create a record in the students table for the given name and email
            $sql = "DELETE FROM students WHERE id=:id";
            
            try
            {
                $query = $db->prepare($sql);
                $query->execute(array(":id"=>$id));
                
                $retVal = $query->rowCount(); // Return # rows affected
            }
            catch (Exception $ex)
            {
                echo "{$ex->getMessage()}<br/>\n";
            }
            
            return $retVal;
        }
    }
?>
