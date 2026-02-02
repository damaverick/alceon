#!/usr/bin/env python3
"""
Convert Excel redirect file to CSV files for WP Engine
Uses only built-in Python libraries
"""
import csv
import zipfile
import xml.etree.ElementTree as ET
from pathlib import Path

def extract_excel_data(xlsx_path):
    """Extract data from Excel file without external dependencies"""
    sheets_data = {}
    
    with zipfile.ZipFile(xlsx_path, 'r') as zip_ref:
        # Get sheet names from workbook.xml
        workbook_xml = zip_ref.read('xl/workbook.xml')
        wb_root = ET.fromstring(workbook_xml)
        
        # Namespace for Excel XML
        ns = {'main': 'http://schemas.openxmlformats.org/spreadsheetml/2006/main'}
        
        sheets = {}
        for sheet in wb_root.findall('.//main:sheet', ns):
            sheet_id = sheet.attrib['{http://schemas.openxmlformats.org/officeDocument/2006/relationships}id']
            sheet_name = sheet.attrib['name']
            sheets[sheet_id] = sheet_name
        
        # Read shared strings
        try:
            shared_strings_xml = zip_ref.read('xl/sharedStrings.xml')
            ss_root = ET.fromstring(shared_strings_xml)
            shared_strings = [si.find('.//main:t', ns).text if si.find('.//main:t', ns) is not None else '' 
                            for si in ss_root.findall('.//main:si', ns)]
        except:
            shared_strings = []
        
        # Read each worksheet
        for i in range(1, len(sheets) + 1):
            worksheet_path = f'xl/worksheets/sheet{i}.xml'
            try:
                worksheet_xml = zip_ref.read(worksheet_path)
                ws_root = ET.fromstring(worksheet_xml)
                
                rows_data = []
                for row in ws_root.findall('.//main:row', ns):
                    row_data = []
                    for cell in row.findall('.//main:c', ns):
                        cell_type = cell.attrib.get('t', '')
                        value_elem = cell.find('.//main:v', ns)
                        
                        if value_elem is not None:
                            value = value_elem.text
                            # If it's a shared string, look it up
                            if cell_type == 's' and value:
                                value = shared_strings[int(value)]
                            row_data.append(value if value else '')
                        else:
                            row_data.append('')
                    
                    if row_data:  # Only add non-empty rows
                        rows_data.append(row_data)
                
                # Find sheet name
                sheet_name = f"Sheet{i}"
                for rid, name in sheets.items():
                    if rid == f'rId{i}':
                        sheet_name = name
                        break
                
                sheets_data[sheet_name] = rows_data
            except Exception as e:
                print(f"Warning: Could not read worksheet {i}: {e}")
                continue
    
    return sheets_data

# Convert Excel to CSV
print("Converting LIVE_REDIRECTS.xlsx to CSV files...\n")

try:
    sheets_data = extract_excel_data('LIVE_REDIRECTS.xlsx')
    
    for sheet_name, rows in sheets_data.items():
        # Create CSV filename
        csv_filename = f"{sheet_name.replace(' ', '_').replace('/', '_').lower()}_redirects.csv"
        
        with open(csv_filename, 'w', newline='', encoding='utf-8') as csvfile:
            writer = csv.writer(csvfile)
            
            row_count = 0
            for row_idx, row in enumerate(rows, start=1):
                # Skip header row if it looks like a header
                if row_idx == 1 and len(row) > 0:
                    first_cell = str(row[0]).lower()
                    if 'current' in first_cell or 'old' in first_cell or 'source' in first_cell:
                        continue
                
                # Get first two columns
                col1 = str(row[0]).strip() if len(row) > 0 and row[0] else ''
                col2 = str(row[1]).strip() if len(row) > 1 and row[1] else ''
                
                # Skip empty rows
                if not col1 and not col2:
                    continue
                
                writer.writerow([col1, col2])
                row_count += 1
        
        print(f"✅ Created: {csv_filename}")
        print(f"   Rows: {row_count}\n")
    
    print("✨ All CSV files created successfully!")
    print("\nFormat: /old-url/,/new-url/")
    print("Ready to upload to WP Engine for bulk redirects.")
    
except Exception as e:
    print(f"❌ Error: {e}")
    print("\nIf this doesn't work, you can manually export each sheet:")
    print("1. Open LIVE_REDIRECTS.xlsx")
    print("2. Click each sheet tab")
    print("3. File → Save As → CSV")
    print("4. Repeat for all sheets")

