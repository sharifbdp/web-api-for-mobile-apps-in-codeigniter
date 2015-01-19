<!DOCTYPE html>
<html>
    <body>
        <h3>Sign Up</h3>
        <form name="input" action="<?php echo site_url('api/sign_up') ?>" method="post">
            Name : <input type="text" name="name"> <br>
            Email : <input type="email" name="email"> <br>
            Password : <input type="password" name="password"> <br>
            Device ID : <input type="text" name="device_id"> <br>
            Phone No : <input type="text" name="phone_no"> <br>
            Address : <input type="text" name="address"> <br>
            <input type="submit" value="Submit">
        </form> 
        <br>


        <h3>Sign In</h3>
        <form name="input" action="<?php echo site_url('api/sign_in') ?>" method="post">
            Email : <input type="email" name="email"> <br>
            Password : <input type="password" name="password"> <br>
            <input type="submit" value="Submit">
        </form> 
        <br>

        <h3>Edit Check</h3>
        <form name="input" action="<?php echo site_url('api/edit') ?>" method="post">
            ID(Update row ID) : <input type="number" name="id"> <br>
            Name : <input type="text" name="name"> <br>
            Password : <input type="password" name="password"> <br>
            Device ID : <input type="text" name="device_id"> <br>
            Phone No : <input type="text" name="phone_no"> <br>
            Address : <input type="text" name="address"> <br>
            <input type="submit" value="Submit">
        </form> 
        <br>

        <!--        <h3>Gallery Image</h3>
                <form name="input" action="http://www.mobioapp.net/apps/road_safety/public/save_image_json" method="post" enctype="multipart/form-data">
                    Image : <input type="file" name="file_name"> <br>
                    Caption : <input type="text" name="caption"> <br>
                    <input type="submit" value="Submit">
                </form>
                <br>-->



    </body>
</html>