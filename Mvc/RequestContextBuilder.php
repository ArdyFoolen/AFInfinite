<?php

namespace AFInfinite\Mvc;

class RequestContextBuilder {
    
    private RequestContext $RequestContext;
    private function SetRequestContext() {
        if (!isset($this->RequestContext)) {
            $this->RequestContext = new RequestContext();
        }
    }
    
    public function WithHttpMethod() : RequestContextBuilder {
        if (!isset($_SERVER['REQUEST_METHOD'])) {
            return $this;
        }
        
        $this->SetRequestContext();
        $this->RequestContext->SetHttpMethod($_SERVER['REQUEST_METHOD']);
        return $this;
    }
    
    public function WithScheme() : RequestContextBuilder {
        $this->SetRequestContext();
        
        if (isset($_SERVER['HTTPS']) &&
            ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
          $protocol = 'https://';
        }
        else {
          $protocol = 'http://';
        }

        $this->RequestContext->SetScheme($protocol);
        return $this;
    }
    
    public function WithDomain() : RequestContextBuilder {
        // Or parse $_SERVER['REQUEST_URI']
        if (!isset($_SERVER['SERVER_NAME'])) {
            return $this;
        }
        
        $this->SetRequestContext();
        $this->RequestContext->SetDomain($_SERVER['SERVER_NAME']);
        return $this;
    }
    
    public function WithPort() : RequestContextBuilder {
        if (!isset($_SERVER['SERVER_PORT'])) {
            return $this;
        }
        
        $this->SetRequestContext();
        
        $port = $_SERVER['SERVER_PORT'];
        $this->RequestContext->SetPort($port);
        return $this;
    }
    
    public function WithRelativePath() : RequestContextBuilder {
        if (!isset($_SERVER['REQUEST_URI'])) {
            return $this;
        }
        
        $request = $_SERVER['REQUEST_URI'];
        $request_arr = explode("?", $request);

        if (!isset($request_arr[0])) {
            return $this;
        }

        $this->SetRequestContext();
        $this->RequestContext->SetRelativePath($request_arr[0]);
        return $this;
    }
    
    public function WithQueryString() : RequestContextBuilder {
        if (!isset($_SERVER['REQUEST_URI'])) {
            return $this;
        }

        $request = $_SERVER['REQUEST_URI'];
        $request_arr = explode ("?", $request);

        if (!isset($request_arr[1])) {
            return $this;
        }

        $query_arr = explode("&", $request_arr[1]);
        $dictionary = [];
        foreach ($query_arr as $keyvalue) {
            $array = explode("=", $keyvalue);
            if (count($array) === 2 && !array_key_exists($array[0], $dictionary)) {
                $dictionary[$array[0]] = $array[1];
            }
        }
        
        $this->SetRequestContext();
        $this->RequestContext->SetQueryString($dictionary);
        return $this;
    }
    
    public function Build() : RequestContext {
        $this->SetRequestContext();
        return $this->RequestContext;
    }
}

