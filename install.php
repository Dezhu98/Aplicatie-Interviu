<?php

//Installer 
if (file_exists ('database.txt')) die('The aplication is already installed!');
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    //Creating database and tables
    
    
    //  test if  set
    $i=0;
    
    if ($_POST['database_name'] != "") $database_name = stripslashes($_POST['database_name']); 
    else {$error[$i]="Please enter Database Name!";$i=$i+1;}
    
    if ($_POST['username'] != "") $username = stripslashes($_POST['username']); 
    else {$error[$i]="Please enter Username!";$i=$i+1;}
    
    if ($_POST['password'] != "") $password = stripslashes($_POST['password']); 
    else {$error[$i]="Please enter Password!";$i=$i+1;}
    
    if ($_POST['server_name'] != "") $server_name = stripslashes($_POST['server_name']); 
    else {$error[$i]="Please enter Server Name!";$i=$i+1;}
    
    //Errors if they exist
    if($i!=0) for($j=0;$j<$i;$j++) echo "<p style='color:red;'>".$error[$j]."</p>";
    else
    {
         //Establishing databse connection
         $conn = new mysqli($server_name, $username, $password, $database_name);
        // Check connection
        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
        else
        {
            //proceed with installation
            
                ///create login table
                $sql1="CREATE TABLE IF NOT EXISTS `$database_name`.`Users` ( `id` SMALLINT NOT NULL AUTO_INCREMENT , `username` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL , `password` VARCHAR(70) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL , `role` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;";
            
                ///create task table
                $sql2="CREATE TABLE IF NOT EXISTS `$database_name`.`Tasks` ( `id` BIGINT NOT NULL AUTO_INCREMENT , `whocreated` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL , `forwho` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL , `duedate` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL , `importance_level` BOOLEAN NOT NULL , `task` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,`taskname` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;";
            
                ///execute sql
                $i=0;
            
                if(mysqli_query($conn, $sql1)) $i=$i+1;
                else echo "ERROR: Could not able to execute $sql1. " . mysqli_error($conn);
            
                if(mysqli_query($conn, $sql2)) $i=$i+1;
                else echo "ERROR: Could not able to execute $sql2. " . mysqli_error($conn);
            
                ///create text file with database information
                $content = "$server_name/$username/$password/$database_name";
                $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/database.txt","wb");
                if ($fp == NULL) $i=$i+1;
                else
                {
                    fwrite($fp,$content);
                    fclose($fp);
                }
            
                //check if everything worked and populate users table with 2 template users
                if($i == 2)
                {
                    $password1=password_hash('1234', PASSWORD_DEFAULT);
                    $password2=password_hash('0000', PASSWORD_DEFAULT);
                    $password3=password_hash('9876', PASSWORD_DEFAULT);
                    $password4=password_hash('pass', PASSWORD_DEFAULT);
                    
                    $sql_insert = "INSERT INTO `Users` (`id`, `username`, `password`, `role`) VALUES (NULL, 'John', '$password1', 'Team Member'),(NULL, 'Mathew', '$password2', 'Team Leader'),(NULL, 'Bob', '$password3', 'Team Member'),(NULL, 'admin', '$password4', 'Admin')";
                    $sql_insert2 = "INSERT INTO `Tasks` (`id`, `whocreated`, `forwho`, `duedate`, `importance_level`, `task`, `taskname`) VALUES (NULL, 'John', 'John', '2021-03-02', '1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend', 'Identify resources to be monitored'), (NULL, 'John', 'John', CURDATE(), '0', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend', 'Define users and workflow'), (NULL, 'John', 'John', '2021-02-10', '0', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend', 'Identify event sources by resource type.'), (NULL, 'Mathew', 'John', CURDATE(), '1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend', 'Emergency Meeting Today'), (NULL, 'Bob', 'Bob', '2021-03-02', '1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend', 'Identify resources to be monitored'), (NULL, 'Bob', 'Bob', CURDATE(), '0', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend', 'Define users and workflow'), (NULL, 'Bob', 'Bob', '2021-02-10', '0', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend', 'Identify event sources by resource type.'), (NULL, 'Mathew', 'Bob', CURDATE(), '1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend', 'Emergency Meeting Today'),(NULL, 'Mathew', 'Mathew', '2021-03-02', '1', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend', 'Identify resources to be monitored'), (NULL, 'Mathew', 'Mathew', CURDATE(), '0', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend', 'Define users and workflow'), (NULL, 'Mathew', 'Mathew', '2021-02-10', '0', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend', 'Identify event sources by resource type.')";
                    
                    
                    if(mysqli_query($conn, $sql_insert) && mysqli_query($conn, $sql_insert2)) 
                    {
                        $conn->close();
                        die("The installation was successful!<br/><br/> You can start it by pressing <a href='index.php'>here</a>!");
                    }
                    else 
                    {   $conn->close();
                     echo  mysqli_error($conn);
                        die("An error has occured during the installation!$password1");
                    }
                    

                    
                    
                    
                }
                else 
                {   $conn->close();
                 echo  mysqli_error($conn);
                    die("An error has occured during the installation!");
                }
        
        }
        
    }
    
       
    
    
}

?>    

<!-- Install form -->

        <!DOCTYPE html>
            <html lang='en'>
                <head>
                    <title>Install</title>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>

                    <link rel='icon' type='image/png' href='images/icons/favicon.ico'/>
                </head>
                
                <body>
                    <h1>Welcome to the installation script!</h1>
                    <h3>Please fill your information:</h3>
                    <form action='install.php' method='post'>
                        <label for='server_name'>Server name:</label>
                        <input type='text' maxlength='20' name='server_name' />
                        <br/>
                        
                        <label for='database_name'>Database name:</label>
                        <input type='text' maxlength='20' name='database_name' /> <i style="color:#808080;font-size:11px;">*the database where you want to install</i>
                        <br/>
                        
                        <label for='username'>Username:</label>
                        <input type='text' maxlength='20' name='username' />
                        <br/>
                        
                        <label for='password'>Password:</label>
                        <input type='password' maxlength='20' name='password' />
                        <br/>
                        
                        <input type='submit' value='Submit'/>

                    </form>
                </body>
            </html>
            
    
    
        
