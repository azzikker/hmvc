<base href="<?php echo base_url(); ?>">
<link rel="stylesheet" type="text/css" href="assets/admin/css/style0.css">
<script type="text/javascript" src="assets/general/js/jquery.js"></script>
<script type="text/javascript" src="assets/admin/js/register/script.js"></script>
<body bgcolor="#f3f3f3">
    <form action="user/save" name="register" method="post" onsubmit="return checkform();">
        <div id="center_frame_register">
            <title>Vigattin Deals Admin</title>
            <header id="header"> 
                <div id="title">Registration</div>
                <div id="sub_title">Please answer the following truthfully.</div>
            </header>
            <table cellpadding="5px" align="center" style="font-size: 10px; font-family: arial; font-weight: ; color: #3f3f3f;">
                <tr>
                    <?php if(isset($_GET['error']) == 1):?><br><td id="error_content" align="center" colspan="2"><h4 class="alert_error">Username Already Exist!</h4></td><?php endif; ?>
                </tr>              
                <tr>
                    <td style="text-align: right;">First Name</td>
                    <td><input style="width: 300px;" type="text" name="txtFN" value="" required="required"></td>
                </tr>
                <tr>
                    <td style="text-align: right;">Last Name</td>
                    <td><input style="width: 300px;" type="text" name="txtLN" value="" required="required"></td>
                </tr>
                <tr>
                    <td style="text-align: right;">Middle Name</td>
                    <td><input style="width: 300px;" type="text" name="txtMN" value="" required="required"></td>
                </tr> 
                <tr>
                    <td style="text-align: right;">Username</td>
                    <td><input style="width: 300px;" type="text" name="txtUN" value="" required="required"></td>
                </tr>
                <tr>
                    <td style="text-align: right;">Password</td>
                    <td><input style="width: 300px;" type="password" name="txtPW" value="" required="required"></td>
                </tr> 
                <tr>
                    <td style="text-align: right;">Confirm Password</td>
                    <td><input style="width: 300px;" type="password" name="txtCPW" value="" required="required"></td>
                </tr>
                <tr>
                    <td style="text-align: right;">User Level</td>
                    <td>
                        <select name="txtUL" required="required">
                            <option value="" selected="selected"></option>
<?php foreach($sql as $row) : ?>
<?php if($row->level_id == 0) : ?>
<?php else : ?>
                            <option value="<?php echo $row->level_id; ?>"><?php echo ucwords($row->level_name); ?></option>
<?php endif ?>
<?php endforeach ?>
                        </select>
                    </td>
                </tr>                 
                <tr>
                    <td style="text-align: right;">E-Mail Address</td>
                    <td><input style="width: 300px;" type="text" name="txtEA" value="" required="required"></td>
                </tr>  
                <tr>
                    <td style="text-align: right;">Contact No.</td>
                    <td><input style="width: 300px;" type="text" name="txtCN" value="" required="required"></td>
                </tr>                                  
                <tr>
                    <td valign="top" style="text-align: right;">Input your message </td>
                    <td><textarea name="txtMSG" style="width: 300px; height: 100px;" cols="" rows="" required="required"></textarea><br>State your qualification to be an admin.</td>
                </tr>                                                                                              
                <tr>
                    <td align="right" colspan="2">
                        <input type="button" value="Back" onclick="window.location.href='user/login'">
                        <input type="submit" name="cmdlogin" value="Sign Up"/>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</body>