<?php
 
class CKEditorForm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
 
    public function index()
    {
        $this->load->view('ckeditor-form',
            array(
                'ckeditor' => $this->_setup_ckeditor('content'),
                // HTML for textarea, populate using your model's property
                'content_html' => ''
        ));
    }
 
    public function save()
    {
        if (FALSE !== $this->input->post('content')) {
            // TODO persist model for 'content' textarea HTML containing uploaded
            // file's img reference.
 
        }
 
        header('Location: /ckeditor-form/');
        exit();
    }
 
    /**
     * Output CKEditor Javascript callback function for image file uploaded
     * in $_FILES['upload']. The GET parameters must also contain the
     * CKEditorFuncNum parameter so the JavaScript callback will reference
     * the correct CKEditor instance.
     */
    public function upload()
    {
        $callback = 'null';
        $url = '';
        $get = array();
 
        // for form action, pull CKEditorFuncNum from GET string. e.g., 4 from
        // /ckeditor-form/upload?CKEditor=content&CKEditorFuncNum=4&langCode=en
        // Convert GET parameters to PHP variables
        $qry = $_SERVER['REQUEST_URI'];
        parse_str(substr($qry, strpos($qry, '?') + 1), $get);
 
        if (!isset($_POST) || !isset($get['CKEditorFuncNum'])) {
            $msg = 'CKEditor instance not defined. Cannot upload image.';
        } else {
            $callback = $get['CKEditorFuncNum'];
 
            try {
                $fileUploader = new LocalFileUploader();
                $url = $fileUploader->upload($_FILES['upload']);
                $msg = "File uploaded successfully to: {$url}";
            } catch (Exception $e) {
                $url = '';
                $msg = $e->getMessage();
            }
        }
 
        // Callback function that inserts image into correct CKEditor instance
        $output = '<html><body><script type="text/javascript">' .
            'window.parent.CKEDITOR.tools.callFunction(' .
            $callback .
            ', "' .
            $url .
            '", "' .
            $msg .
            '");</script></body></html>';
 
        echo $output;
    }
 
    /**
     * Retrieve configuration properties for CKEditor instance. Ensure the
     * CodeIgniter helper has been copied to CI's system directory.
     *
     * @param $id HTML id="" attribute CKEditor instance is enabled for.
     *
     * @return array First parameter for display_ckeditor() function invoked
     *         in the CI view.
     */
    private function _setup_ckeditor($id)
    {
        $this->load->helper('url');
        $this->load->helper('ckeditor');
 
        $ckeditor = array(
            'id' => $id,
            'path' => 'assets/js/ckeditor',
            'config' => array(
                'toolbar' => 'Full',
                'width' => '800px',
                'height' => '400px',
                // path to submit image upload form to. i.e., upload() above
                'filebrowserImageUploadUrl' => '/ckeditor-form/upload')
 
                // add additional CKEditor properties here
        );
 
        return $ckeditor;
    }
}