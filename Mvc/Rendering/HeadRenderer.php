<?php

namespace AFInfinite\Mvc\Rendering;

class HeadRenderer extends HtmlRenderer {
    
    protected string $TypeName = 'Head';
    
    public function Render() {
        echo "<head>";
        if (isset($this->Children['Meta'])) {
            foreach ($this->Children['Meta'] as $meta)
                $meta->Render();
        }
        if (isset($this->Children['Title'])) {
            $this->Children['Title']->Render();
        }
        if (isset($this->Children['Link'])) {
            foreach ($this->Children['Link'] as $link)
                $link->Render();
        }
        echo "</head>";
    }
}
