# AnomalyDetector plugin for LMS

Detection of potential anomalies according to defined rules.
![](anomaly-detector.png?raw=true)
## How it works

- Detects TV tariffs based on tax value that are assigned to non-STB devices.

## Requirements

Installed [LMS](https://lms.org.pl/) or [LMS-PLUS](https://lms-plus.org) (recommended).

## Installation

* Copy files to `<path-to-lms>/plugins/`
* Run `composer update` or `composer update --no-dev`
* Go to LMS website and activate it `Configuration => Plugins`

## Configuration

Go to `<path-to-lms>/?m=configlist` then add config parameters and values. 
Example config below:
```
anomaly-detector.iptv_tax_rate_id=3
```
You can get your ID for `iptv_tax_rate` on LMS page `<path-to-lms>/?m=taxratelist`. Default value is 3.


## Donation

* Bitcoin (BTC): bc1qvwahntcrwjtdp0ntfd0l6kdvdr9d9h6atp6qrr
* Ethereum (ETH): 0xEFCd4b066195652a885d916183ffFfeEEd931f40
