# SaaS Billing System

## Overview
This is a multi-tenant SaaS billing and subscription system built using PHP.

## Features
- Multi-tenant architecture
- Subscription plans
- Billing engine with proration
- Upgrade & downgrade handling
- Credit system
- Usage-based billing
- Payment gateway abstraction
- Webhook system

## Setup
- Install XAMPP
- Run `composer install`
- Setup database in phpMyAdmin

## Architecture
- Repository Pattern
- Service Layer
- Dependency Injection

## Notes
- All monetary values are stored as integers (paise)
- No floating point calculations used
