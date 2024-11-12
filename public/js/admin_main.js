import { initializePopover } from './navigations.js';
import * as residentTable from './residentTable.js';

initializePopover();
residentTable.initDataTable();
residentTable.spinRefreshButton();
residentTable.deleteResidents();
residentTable.initializeSelectAllCheckbox();

