# Powered Lifting Equipment (PLE) System Documentation

## Overview
The PLE (Powered Lifting Equipment) system is a comprehensive solution for managing daily equipment inspections and safety compliance. It consists of both physical inspection procedures and a digital tracking system implemented as a web-based application.

## System Components

### 1. Physical Components
#### Pre-Operational Checklist Form
- Daily inspection form for recording equipment checks
- Includes fields for:
  - PLE ID and equipment identification
  - Daily inspection records (SAT through FRI)
  - Inspector information and timestamps
  - Four main inspection categories
  - Repair and service status tracking

#### Job Aid Documentation
Provides detailed inspection procedures for:
1. **Damages Assessment**
   - Fork and guard crack inspection
   - Cover/guard presence verification
   - Cable and battery condition check
   - Tire wear evaluation
   - Ground prong inspection

2. **Leak Detection**
   - Drive unit inspection
   - Brake system check
   - Hydraulic hose examination
   - Propane tank inspection
   - Fluid leak detection

3. **Safety Device Verification**
   - Horn functionality
   - Backup alarm operation
   - Warning/backup light check
   - Warning decal presence/legibility

4. **Operational Control Testing**
   - Gauge functionality
   - Steering system check
   - Hydraulic lift/tilt operation
   - Brake system verification
   - Key ignition integrity

### 2. Digital Implementation

#### Technology Stack
- Single Page Application (SPA) using Vue.js
- Local data storage using Dexie.js (IndexedDB wrapper)
- Responsive design with custom CSS

#### Core Features

1. **Equipment Management**
   - Equipment inventory tracking
   - Unique PLE ID assignment
   - Department-based organization
   - Equipment details storage (make, model, serial number)

2. **Inspection Walk Management**
   - Time-restricted inspections (12:00 AM - 7:00 AM)
   - Digital checklist completion
   - Inspector identification tracking
   - Real-time status updates

3. **Data Management**
   - Local database storage
   - Export functionality for backup
   - Database initialization with default equipment
   - Historical record keeping

## Standard Operating Procedures

### Equipment Inspection Process
1. **Pre-Inspection Requirements**
   - Must be performed between 12:00 AM and 7:00 AM
   - Requires PLE certified manager with valid license
   - Access to Pre-Operational Checklist Binder

2. **Inspection Workflow**
   - Obtain checklist from manager's office
   - Record equipment identification and timing
   - Complete four-point inspection
   - Document any issues or repairs needed
   - Submit and file completed checklist

3. **Issue Resolution**
   - Tag out damaged equipment
   - Submit repair requests via Service Channel
   - Track work orders
   - Document equipment status daily

### Management Review Process
1. **Daily Review**
   - Backroom shift manager review
   - Accuracy verification
   - Exception documentation
   - Corrective action tracking

2. **Documentation Management**
   - Chronological filing system
   - Monthly organization
   - Record retention compliance
   - Exception resolution tracking

## Equipment Inventory

### Equipment Categories and Identification
1. **Walkie-stackers (R-series)**
   - Designated by R# identifiers
   - Used in backroom and garden center

2. **Electric Jacks (E-series)**
   - Designated by E# identifiers
   - Primary backroom equipment

3. **Fork-lifts (F-series)**
   - Designated by F# identifiers
   - Garden center operations

4. **Scissor lifts (S-series)**
   - Designated by S# identifiers
   - Specialized elevation equipment

## Data Management

### Database Structure
1. **Equipment Table**
   - Equipment identification
   - Technical specifications
   - Department assignment
   - Normalized identifiers

2. **Checklist Table**
   - Inspection records
   - Timestamp information
   - Inspector details
   - Equipment status

### Data Operations
1. **Export Functionality**
   - JSON format exports
   - Complete database backup
   - Historical record preservation
   - Version tracking

2. **Database Management**
   - Initialization capabilities
   - Reset functionality
   - Data integrity maintenance
   - Default equipment templates

## Compliance and Safety

### Key Requirements
1. **Timing Compliance**
   - Strict inspection window (12:00 AM - 7:00 AM)
   - Daily completion requirement
   - Management review timing

2. **Documentation Standards**
   - Accurate record keeping
   - Complete form requirements
   - Clear issue documentation
   - Proper filing procedures

3. **Safety Protocols**
   - Equipment tagging procedures
   - Repair request processes
   - Status tracking requirements
   - Management oversight

### Record Retention
- Compliance with Records Policy (PR-03)
- Chronological organization
- Accessibility requirements
- Audit preparation

## System Access and Security

### User Roles
1. **Inspectors**
   - Must be PLE certified
   - Valid license requirement
   - Specific time window access

2. **Management**
   - Review responsibilities
   - Exception handling
   - Corrective action authority

### Data Security
- Local data storage
- Export capabilities
- Backup procedures
- Access controls
