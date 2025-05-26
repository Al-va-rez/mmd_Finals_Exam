<?php
    require_once '../core/dbConfig.php';
    require_once '../core/myFunctions.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Google Docs</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    </head>
    <body>
        <div class="flex flex-col items-center gap-8 bg-gray-100 w-full h-fit mx-auto py-20 mb-2">
            <div class="text-2xl">Welcome, <?= $_SESSION['username'] ?></div>
            <button id="createDocument" class="rounded-full bg-blue-500 px-12 py-5 text-white font-semibold hover:bg-blue-600">Create document</button>
            <button type="button" onclick="location.href='../core/handleForms.php?btn_Logout=1'" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700">
                Logout
            </button>
        </div>


        <!-- LIST OF DOCUMENTS -->
        <div class="flex flex-col mx-auto max-w-[75%] max-h-fit ">

            <!-- RECENT DOCUMENTS -->
            <?php $recentDocuments = getRecentDocuments($pdo, $_SESSION['user_id']); ?>
            
            <!-- HEADER -->
            <div class="flex flex-row flex-nowrap px-4 py-3 w-full font-semibold text-gray-700">
                <?php if (count($recentDocuments) > 0) { ?>
                    <div class="w-6/12 font-semibold text-xl">Today</div>
                <?php } else { ?>
                    <div class="w-6/12 font-semibold text-xl"></div>
                <?php } ?>
                <div class="w-2/12 text-center text-lg">Owned by</div>
                <div class="w-5/12 text-center text-lg">Last Opened</div>
                <div class="w-1/12 text-center text-lg">Sort</div>
            </div>

            <!-- CONTENT -->
            <div class="divide-y-2">
                <?php foreach ($recentDocuments as $document) {?>

                    <div class="documents" onclick="location.href='../workspace/main.php?docId=<?= $document['document_id'] ?>'">
                        <div class="documentContainer">
                            <div class="columnIcon">
                                <img class="documentIcon">
                            </div>
                            <div class="columnTitle">
                                <div class="max-w-[70%] truncate">
                                    <?= $document['title'] ?>
                                </div>
                            </div>
                            <div class="columnOwner"><?= $document['username'] == $_SESSION['username'] ? 'me' : $document['username'] ?></div>
                            <div class="columnDate"><?= $document['date_created'] ?></div>
                            <div class="columnMisc">
                                <button class="p-2 hover:bg-gray-200 rounded-full">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="gray" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
            <!-- /RECENT DOCUMENTS -->


            <!-- OLDER DOCUMENTS -->
            <?php $olderDocuments = getOlderDocuments($pdo, $_SESSION['user_id']); ?>

            <!-- HEADER -->
            <div class="w-full px-4 py-3 w-full font-semibold">Older Documents</div>
            
            <!-- CONTENT -->
            <div class="divide-y-2">
                <?php foreach ($olderDocuments as $document) {?>

                    <div class="documents" onclick="location.href='../workspace/main.php?docId=<?= $document['document_id'] ?>'">
                        <div class="documentContainer">
                            <div class="columnIcon">
                                <img class="documentIcon">
                            </div>
                            <div class="columnTitle">
                                <div class="max-w-[70%] truncate">
                                    <?= $document['title'] ?>
                                </div>
                            </div>
                            <div class="columnOwner"><?= $document['username'] == $_SESSION['username'] ? 'me' : $document['username'] ?></div>
                            <div class="columnDate"><?= $document['date_created'] ?></div>
                            <div class="columnMisc">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="gray" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
            <!-- /OLDER DOCUMENTS -->

        </div>
        <!-- /LIST OF DOCUMENTS -->

        <script src="user_Scripts.js"></script>
    </body>
</html>