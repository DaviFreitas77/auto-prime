<?php
function renderToast($message)
{
?>
    <div id="toast" class="fixed bottom-5 right-5 flex items-center justify-between bg-gray-800 text-white px-8 py-4 rounded shadow-lg">

        <div class="toast-content font-sans text-sm">
            <?=
            $message;
            ?>
        </div>

        <div class="toast-icon w-7 h-5 flex-shrink-0">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-full h-full fill-current text-white">
                <path d="M0 0h24v24H0z" fill="none"></path>
                <path d="M15.795 8.342l-5.909 9.545a1 1 0 0 1-1.628 0l-3.182-4.909a1 1 0 0 1 1.629-1.165l2.556 3.953L14.165 7.51a1 1 0 0 1 1.63 1.165z"></path>
            </svg>
        </div>
    </div>
<?php
}
?>