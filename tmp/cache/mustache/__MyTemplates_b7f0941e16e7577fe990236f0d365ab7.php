<?php
class __MyTemplates_b7f0941e16e7577fe990236f0d365ab7 extends Mustache_Template
{
    protected $strictCallables = true;
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';
        $newContext = array();

        $buffer .= $indent . '        <div class="row mt-xxlg">
';
        $buffer .= $indent . '          <div class="col-md-5 mt-lg">
';
        $buffer .= $indent . '            <img src="images/photo-3.png" alt="" class="img-responsive">
';
        $buffer .= $indent . '          </div>
';
        $buffer .= $indent . '          <div class="col-md-6  col-md-offset-1">
';
        $buffer .= $indent . '            <h4 class="lead text-secondary mt-xxlg">Title of this section</h4>
';
        $buffer .= $indent . '            <p class="lead text-gray-dark">Choose from multiple, completely unique designs built into one incredible theme – no additional setup required. There are currently four Stacks to choose from (with more in development).</p>
';
        $buffer .= $indent . '            <a href="#" class="btn btn-primary btn-lg">Read more</a> <a href="#" class="btn btn-secondary-o btn-lg">Download</a>
';
        $buffer .= $indent . '          </div>
';
        $buffer .= $indent . '        </div>
';
        return $buffer;
    }
}