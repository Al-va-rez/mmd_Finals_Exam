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
            <div class="text-2xl">Welcome</div>
            <button id="createDocument" class="rounded-full bg-blue-500 px-12 py-5 text-white font-semibold hover:bg-blue-600">Create document</button>
            <button type="button" onclick="location.href='../core/handleForms.php?btn_Logout=1'" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700">
                Logout
            </button>
        </div>

        <?php $checkSuspension = check_UserSuspended($pdo, $_SESSION['user_id']); ?>

        <!-- LIST OF DOCUMENTS -->
        <div class="flex flex-col mx-auto max-w-[75%] max-h-fit ">

            <!-- RECENT DOCUMENTS -->
            <?php $recentDocuments = getRecentDocuments($pdo, $_SESSION['user_id']); ?>
            
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

            <div class="divide-y-2">
                <?php foreach ($recentDocuments as $document) {?>

                    <?php $check_documentShared = check_documentShared($pdo, $document['document_id'], $_SESSION['user_id']); ?>
                    <?php $check_documentOwned = check_documentOwned($pdo, $document['document_id'], $_SESSION['user_id']); ?>

                    <div class="documents" onclick="<?= (!$checkSuspension && ($check_documentShared || $check_documentOwned)) ? "location.href='../workspace/main.php?docId={$document['document_id']}'" : "alert('Account is suspended')" ?>">
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
                            <div class="columnMisc">Accessibility</div>
                        </div>
                    </div>

                <?php } ?>
            </div>
            <!-- /RECENT DOCUMENTS -->


            <!-- OLDER DOCUMENTS -->
            <?php $olderDocuments = getOlderDocuments($pdo, $_SESSION['user_id']); ?>

            <div class="w-full px-4 py-3 w-full font-semibold">Older Documents</div>
            
            <div class="divide-y-2">
                <?php foreach ($olderDocuments as $document) {?>

                    <?php $check_documentShared = check_documentShared($pdo, $document['document_id'], $_SESSION['user_id']); ?>
                    <?php $check_documentOwned = check_documentOwned($pdo, $document['document_id'], $_SESSION['user_id']); ?>

                    <div class="documents" onclick="<?= (!$checkSuspension && ($check_documentShared || $check_documentOwned)) ? "location.href='../workspace/main.php?docId={$document['document_id']}'" : "alert('Account is suspended')" ?>">
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
                            <div class="columnMisc">Accessibility</div>
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