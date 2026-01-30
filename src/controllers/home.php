<?php
$domainService = new Domain();
$domain_list = $domainService->getActiveList();
$domain_default = $domainService->getDefault();
?>