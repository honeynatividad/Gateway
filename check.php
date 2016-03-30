<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$url = $_SERVER['webservice'].'/Members.svc/MembersInfo/?Certno=5443460';
            $getxml = @file_get_contents($url);
                
           
                $xml = simplexml_load_string($getxml);
                $data = $xml->MembersInfoResult;
                $namespaces = $data->getNameSpaces(true);
                $info = $data->children($namespaces['a']);	
print_r($info);