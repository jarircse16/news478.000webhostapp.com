<?php
// Function to format file size in human-readable format
function formatFileSize($size)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $i = 0;
    while ($size >= 1024 && $i < 4) {
        $size /= 1024;
        $i++;
    }
    return round($size, 2) . ' ' . $units[$i];
}

// Function to list files and directories in the given path recursively
function listDirectory($dir)
{
    // Open a directory handle
    if ($handle = opendir($dir)) {
        // Initialize arrays to store files and folders
        $files = array();
        $folders = array();

        // Loop through the directory
        while (($file = readdir($handle)) !== false) {
            // Ignore current and parent directories
            if ($file !== '.' && $file !== '..') {
                // Check if the current item is a directory
                if (is_dir($dir . '/' . $file)) {
                    // Add folder name to the folders array
                    $folders[] = $file;
                } else {
                    // Add file name to the files array along with file size and date created
                    $fileInfo = array(
                        'name' => $file,
                        'size' => formatFileSize(filesize($dir . '/' . $file)),
                        'created' => date("Y-m-d H:i:s", filectime($dir . '/' . $file))
                    );
                    $files[] = $fileInfo;
                }
            }
        }
        // Close the directory handle
        closedir($handle);

        // Sort the arrays in ascending order
        sort($files);
        sort($folders);

        // Display the folders
        foreach ($folders as $folder) {
            echo "<p><strong>Folder: $folder</strong> (<a href='?path={$dir}/{$folder}'>View Contents</a>)</p>";
        }

        // Display the files
        foreach ($files as $fileInfo) {
            echo "<p><a href='{$dir}/{$fileInfo['name']}'>{$fileInfo['name']}</a> (Size: {$fileInfo['size']}, Created: {$fileInfo['created']})</p>";
        }
    }
}

// Check if a specific path is requested
if (isset($_GET['path'])) {
    $directory = $_GET['path'];
} else {
    // Default directory path to list
    $directory = './';
}

// Call the function with the specified directory
listDirectory($directory);
?>
