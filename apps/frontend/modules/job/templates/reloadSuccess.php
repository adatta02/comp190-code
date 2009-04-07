<?php include_partial("renderList", 
                      array("pager" => $pager, 
                            "object" => $routeObject,
                            "route" => $route,
                            "viewingCaption" => $viewingCaption,
                            "propelType" => $propelType,
                            "renderStatus" => $renderStatus)); ?>