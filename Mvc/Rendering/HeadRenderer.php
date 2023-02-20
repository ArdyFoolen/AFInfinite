<?php

namespace AFInfinite\Mvc\Rendering;

class HeadRenderer extends HtmlRenderer {
    
    public function SetRenderer(HtmlRenderer $renderer) : bool {
        if ($renderer instanceof MetaRenderer) {
            $this->Children['Meta'][] = $renderer;
                return true;
        }
        if ($renderer instanceof TitleRenderer) {
            $this->Children['Title'] = $renderer;
            return true;
        }
        if ($renderer instanceof LinkRenderer) {
            $this->Children['Link'][] = $renderer;
            return true;
        }
        return $this->SetChild($renderer);
    }
    
    public function Render() {
        global $baseUrl;
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
