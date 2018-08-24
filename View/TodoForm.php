<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        <?php print htmlentities($title) ?>
        </title>
    </head>
    <body>
        <?php
        if ( $errors ) {
            print '<ul class="errors">';
            foreach ( $errors as $field => $error ) {
                print '<li>'.htmlentities($error).'</li>';
            }
            print '</ul>';
        }
        ?>
        <form method="POST" action="">
            <label for="name">Name:</label><br/>
            <input type="text" name="name" value="<?php print htmlentities($name) ?>"/>
            <br/>
            
            <label for="status">Status:</label><br/>
            <input type="text" name="status" value="<?php print htmlentities($status) ?>"/>
            <br/>
            <input type="hidden" name="form-submitted" value="1" />
            <input type="submit" value="Submit" />
        </form>
        
    </body>
</html>