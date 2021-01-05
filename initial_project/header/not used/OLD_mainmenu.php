
    <center>
        <table width="100%">
            <tr>
                <th class="thheader">
                    Menu
                </th>
            </tr>
            <tr>
                <td class="vertical-menu1">

                    <a href="index.php">Home</a>
                    <a href="explore.php">Town</a>
                    <a href="inventory.php">Items</a>
                    <a href="shops.php">Shops</a>
                    <a href="criminal.php">Crimes</a>
                    <a href="gym.php">Gym</a>
                    <a href="fight.php">Fight</a>

                </td>

            </tr>

            <tr>
                <th class="thheader">
                    Account
                </th>
            </tr>
            <tr>
                <td class="vertical-menu1">

                    <a href="viewuser.php?u=<?php echo"{$ir[ 'userid']} ";?>" rel="external">Profile</a>
                    <a href="preferences.php">Settings</a>
                    <a href="preport.php">Report</a>
                    <a href="logout.php">Logout</a>

                </td>

            </tr>
            <?php
            if($ir['user_level']>1)
            {
                echo' <tr>
                <th class="thheader">
                    Staff
                </th>
            </tr>
            <tr>
                <td class="vertical-menu1">
                    <a href="/staffpanel/staff.php">Staff Panel</a>

                </td>

            </tr>';
            }
            ?>
        </table>
    </center>