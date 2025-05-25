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
            <div class="text-2xl">Welcome</div>
            <button type="button" onclick="location.href='../core/handleForms.php?btn_Logout=1'" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700">
                Logout
            </button>
        </div>


        <!-- TAB BUTTONS -->
        <div class="flex flex-row w-[73%] mx-auto">
            <button class="tabButton">Documents</button>
            <button class="tabButton">Users</button>
        </div>
        <!-- /TAB BUTTONS -->


        <!-- LIST OF DOCUMENTS -->
        <div id="docList" class="tabContent">

            <?php $allDocuments = getAllDocuments($pdo); ?>
            
            <!-- HEADER -->
            <div class="flex flex-row flex-nowrap px-4 py-3 w-full font-semibold text-gray-700">
                <div class="w-6/12 font-semibold text-xl">Title</div>
                <div class="w-2/12 text-center text-lg">Owner</div>
                <div class="w-5/12 text-center text-lg">Last Opened</div>
                <div class="w-1/12 text-center text-lg">Sort</div>
            </div>
            <!-- /HEADER -->


            <!-- CONTENT -->
            <div class="divide-y-2">
                <?php foreach ($allDocuments as $document) {?>

                    <div class="documents">
                        <!-- if else statement for the onclick -->
                        <div class="documentContainer" onclick="location.href='../workspace/main.php?docId=<?= $document['document_id'] ?>'">
                            <div class="columnIcon">
                                <img class="documentIcon">
                            </div>
                            <div class="columnTitle">
                                <div class="max-w-[70%] truncate">
                                    <?= $document['title'] ?>
                                </div>
                            </div>
                            <div class="columnOwner"><?= $document['username'] ?></div>
                            <div class="columnDate"><?= $document['date_created'] ?></div>
                            <div class="columnMisc">Accessibility</div>
                        </div>
                    </div>

                <?php } ?>
            </div>
            <!-- /CONTENT -->

        </div>
        <!-- /LIST OF DOCUMENTS -->


        <!-- LIST OF USERS -->
        <div id="userList" class="tabContent">

            <?php $allUsers = getAllUsers($pdo); ?>
            
            <!-- HEADER -->
            <div class="flex flex-row flex-nowrap px-4 py-3 w-full font-semibold items-center">
                <div class="w-5/12 text-lg">Username</div>
                <div class="w-2/12 text-center text-lg">Firs Name</div>
                <div class="w-5/12 text-center text-lg">Last Name</div>
                <div class="w-1/12 text-center text-lg">Date Registered</div>
                <div class="w-1/12 text-center text-lg"></div>
            </div>
            <!-- /HEADER -->


            <!-- CONTENT -->
            <div class="divide-y-2">
                <?php foreach ($allUsers as $user) {?>

                    <div class="gdocsUsers">
                        <!-- if else statement for the onclick (document shared) -->
                        <div class="userContainer">
                            <div class="columnUsername"><?= $user['username'] ?></div>
                            <div class="columnFirstName"><?= $user['first_Name'] ?></div>
                            <div class="columnLastName"><?= $user['last_Name'] ?></div>
                            <div class="columnRegister"><?= $user['date_added'] ?></div>
                            <button class="columnSuspend"></button>
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