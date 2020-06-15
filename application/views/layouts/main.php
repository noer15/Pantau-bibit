<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('layouts/header',['title' => $title]); ?>
    <body>
        <div class='loader'>
            <div class='spinner-grow text-primary' role='status'>
                <span class='sr-only'>Loading...</span>
            </div>
        </div>
        <?php $this->load->view('layouts/sidebar'); ?>
       <?php $content ?>
        
       <?php $this->load->view('layouts/footer'); ?>
    </body>
</html>