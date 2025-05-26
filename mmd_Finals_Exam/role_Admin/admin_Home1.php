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
            <button id="docTab" class="tabButton">Documents</button>
            <button class="tabButton" onclick="location.href = 'admin_Home2.php'">Users</button>
        </div>
        <!-- /TAB BUTTONS -->


        <!-- LIST OF DOCUMENTS -->
        <div id="docList" class="tabContent">
            
            <!-- HEADER -->
            <div class="flex flex-row flex-nowrap px-4 py-3 w-full font-semibold text-gray-700">
                <div class="w-6/12 font-semibold text-xl">Title</div>
                <div class="w-2/12 text-center text-lg">Owner</div>
                <div class="w-5/12 text-center text-lg">Last Opened</div>
                <div class="w-1/12 text-center text-lg"></div>
            </div>
            <!-- /HEADER -->


            <!-- CONTENT -->
            <div class="divide-y-2">

                <?php $allDocuments = getAllDocuments($pdo); ?>

                <?php foreach ($allDocuments as $document) {?>

                    <?php $docId = $document['document_id']; ?>

                    <?php $check_documentShared = check_documentShared($pdo, $docId, $_SESSION['user_id']); ?>

                    <!-- individual record -->
                    <div class="documents" data-doc-id="<?= $docId ?>" onclick="<?= ($check_documentShared) ? "location.href='../workspace/main.php?docId={$docId}'" : "alert('Document not shared')" ?>">

                        <!-- container for record details -->
                        <div class="documentContainer">

                            <!-- icon -->
                            <div class="columnIcon">
                                <img class="documentIcon">
                            </div>
                            <!-- title -->
                            <div class="columnTitle">
                                <div class="max-w-[70%] truncate">
                                    <?= $document['title'] ?>
                                </div>
                            </div>
                            <!-- owner -->
                            <div class="columnOwner"><?= $document['username'] == $_SESSION['username'] ? 'me' : $document['username'] ?></div>
                            <!-- date created/accessed/updated -->
                            <div class="columnDate"><?= $document['date_created'] ?></div>
                            <!-- delete button -->
                            <div class="columnMisc"></div>

                        </div>

                    </div>

                <?php } ?>

            </div>
            <!-- /CONTENT -->

        </div>
        <!-- /LIST OF DOCUMENTS -->
        


        <script src="admin_Scripts.js"></script>
    </body>
</html>