<?php
    require_once '../core/dbConfig.php';
    require_once '../core/myFunctions.php';
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Homepage</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    </head>
    <body>

        <div class="flex flex-col items-center gap-8 bg-gray-100 w-full h-fit mx-auto py-20">
            <!-- greetings -->
            <div class="text-2xl">Welcome, <?= $_SESSION['username'] ?></div>
            <!-- logout -->
            <button type="button" onclick="location.href='../core/handleForms.php?btn_Logout=1'" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700">
                Logout
            </button>
        </div>


        <!-- TAB BUTTONS -->
        <div class="flex flex-row w-[73%] mx-auto mt-6 mb-4">
            <button class="tabButton" onclick="location.href = 'admin_Home1.php'">Documents</button>
            <button id="userTab" class="tabButton">Users</button>
        </div>
        <!-- /TAB BUTTONS -->


        <!-- LIST OF USERS -->
        <div id="userList" class="tabContent">

            <?php $allUsers = getAllUsers($pdo); ?>
            
            <!-- HEADER -->
            <div class="flex flex-row flex-nowrap px-4 py-3 w-full font-semibold items-center">
                <div class="columnUsername text-lg">Username</div>
                <div class="columnFirstName text-lg">First Name</div>
                <div class="columnLastName text-lg">Last Name</div>
                <div class="columnRegister text-lg">Date Registered</div>
                <div class="columnStatus text-lg">Account Status</div>
                <div class="columnSuspend">
                    <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="black" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.441 1.559a1.907 1.907 0 0 1 0 2.698l-6.069 6.069L10 19l.674-3.372 6.07-6.07a1.907 1.907 0 0 1 2.697 0Z"/>
                    </svg>
                </div>
            </div>
            <!-- /HEADER -->


            <!-- CONTENT -->
            <div class="divide-y-2">

                <?php foreach ($allUsers as $user) {?>

                    <!-- individual record -->
                    <div class="gdocsUsers">

                        <!-- container for record details -->
                        <div class="userContainer" data-user-id="<?= $user['user_id'] ?>">

                            <!-- username -->
                            <div class="columnUsername"><?= $user['username'] ?></div>
                            <!-- first name -->
                            <div class="columnFirstName"><?= $user['first_Name'] ?></div>
                            <!-- last name -->
                            <div class="columnLastName"><?= $user['last_Name'] ?></div>
                            <!-- date registered -->
                            <div class="columnRegister"><?= $user['date_added'] ?></div>
                            <!-- account status -->
                            <div class="columnStatus <?= ($user['account_Status'] == 'Active') ? 'text-green-700' : 'text-red-500' ?>">
                                <?= $user['account_Status'] ?>
                            </div>
                            <!-- suspend -->
                            <div class="columnSuspend">
                                <input type="checkbox" class="accountStatus" <?= ($user['account_Status'] == 'Suspended') ? 'checked' : '' ?>>
                            </div>
                            
                        </div>

                    </div>

                <?php } ?>

            </div>
            <!-- /CONTENT -->

        </div>
        <!-- /LIST OF USERS -->
        


        <script src="admin_Scripts.js"></script>
    </body>
</html>