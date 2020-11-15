<?php

namespace Joakim\View;

/**
 * Style chooser.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><h1>test</h1>
<p><?php if ($valid) : ?>
    Valid
    <?php else : ?>
    Inte valid
<?php endif; ?>
</p>

