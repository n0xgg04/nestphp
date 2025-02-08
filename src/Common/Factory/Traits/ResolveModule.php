<?php
    namespace Common\Factory\Traits;

    trait ResolveModule{
        public function resolveModule($module){
            $module = explode('@', $module);
            $module[0] = 'App\\Controllers\\'.$module[0];
            return $module;
        }
    }
