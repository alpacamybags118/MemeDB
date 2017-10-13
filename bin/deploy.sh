#!/usr/bin/env bash

configure_aws_cli(){
	aws --version
	aws configure set default.region us-west-2
	aws configure set default.output json
}
