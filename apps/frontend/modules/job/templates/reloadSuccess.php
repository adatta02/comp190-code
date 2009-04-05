<?php include_partial("renderList", 
                      array("pager" => $pager, 
                            "object" => $routeObject,
                            "route" => $route,
                            "propelType" => $propelType,
                            "renderStatus" => $renderStatus)); ?>