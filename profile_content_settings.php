<div style="min-height: 400px; width: 100%; padding: 20px; padding-right: 0 px;background-color:white;text-align:center;">
    <div style="padding: 20px; max-width:350px;display: inline-block;" >

        <form method="post" enctype="multipart/form-data">


        <?php

            $settings_class = new Settings();

            $settings = $settings_class->get_settings($_SESSION['petbook_userid']);

            if(is_array($settings))
            {
                echo "<input type = 'text' id='textbox' name='first_name'value='".htmlspecialchars($settings['first_name'])."' placeholder='First Name' />";
                echo "<input type = 'text' id='textbox' name='last_name' value='".htmlspecialchars($settings['last_name'])."'placeholder='Last Name'/>";

                echo "<select id ='textbox' name='email' style='height: 30px;>
                        <option>value='".htmlspecialchars($settings['gender'])."'</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>";

                echo "<input type = 'text' id='textbox' name='email'value='".htmlspecialchars($settings['email'])."' placeholder='E-mail'/>";
                echo "<input type = 'password' id='textbox' name='password' value='".htmlspecialchars($settings['password'])."' placeholder='Password'/>";
                echo "<input type = 'password' id='textbox' name='password2' value='".htmlspecialchars($settings['password'])."' placeholder='Password'/>";

                echo "<br>About me:<br>
                    <textarea id='textbox' style='height:200px;' name='about'>".htmlspecialchars($settings['about'])."</textarea>";

                echo '<input id ="post_button" type="submit" value="Save">';


            }

        ?>
        </form>
    </div>
</div>