#!/bin/bash
service named restart
(sleep 5; apachectl restart) &
