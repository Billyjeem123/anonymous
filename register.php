          <?php

          // Expecting Username and Password as a Parameter From FrontEnd
          //https://sites.local/anonymous/register.php?username={'incoming Parameter'}&password={'incoming Parameter'}


          require_once("vendor/init.php");

          $database = new Database();
          $user = new Users();

          if (isset($_POST['username']) and !empty($_POST['password']) and !empty($_POST['username']) ) {


          $user->username = $database->escape_string($_POST['username']);
          $user->password = trim($_POST['password']);
          $user->passhash =  password_hash($user->password, PASSWORD_BCRYPT, [12]);


          if ($user->UserExists($user->username)) {

            $array = [
              'success' => false,
              'message' => 'An account already exists with this username',
              'username' =>  $user->username,

            ];
            $return = json_encode($array);
            echo "$return";
            exit();
          } else {


            if ($user::RegisterUsers($user->username, $user->passhash) == true) {


              $lastId = $database->the_insert_id();

              if ($lastId == true) {

                $result =  $user->Geolocation();

                $countryName =  $result->country_name;
                $countryCity =  $result->country_capital;
                $fullname = $countryName .  '  ' .  $countryCity;


                $InsertLocation = Users::InsertLocation($lastId, $fullname);

                $array = [
                  'success' => true,
                  'message' => 'Account created successfully',
                  'username' =>  $user->username,
                  'userid' => $lastId
                ];


                $return = json_encode($array);
                echo "$return";
                exit();
              }
            } else {

              $array = [
                'success' => false,
                'message' => 'Failed to create account',
                // 'username' => $user->username
              ];
              $return = json_encode($array);
              echo "$return";
              exit();
            }
          
          }
          
         } else {

            $array = [
              'success' => false,
              'message' => "Username or password is required."
            ];
            $return = json_encode($array);
            echo "$return";
            exit();
          }

        
      
