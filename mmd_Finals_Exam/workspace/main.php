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
        <?php include 'ribbon.php'; ?>

        <?php $getDocumentById = getDocumentById($pdo, $_GET['docId'], $_SESSION['user_id']); ?>

        <div class="flex flex-col items-center justify-center mt-8">
            <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg border border-gray-200">
                <div class="px-8 py-6 min-h-[600px] outline-none" contenteditable="true" spellcheck="true" id="editor" data-doc-id="<?= $_GET['docId'] ?>">
                    <?= $getDocumentById['content'] ?>
                </div>
            </div>
        </div>

        
        <script src="workspace_Scripts.js"></script>
    </body>
</html>