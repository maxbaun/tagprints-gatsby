import {CancelToken} from 'axios';
let Cancel = CancelToken.source();

export function buildUrl(data) {
	let baseUrl = 'https://api.smugmug.com';
	let defaultParams = '?APIKey=xXZBhYlkrrLAw7iSZaDP6Ipv7Irib56u';

	baseUrl += data.path;
	baseUrl += defaultParams;

	if (data.start) {
		baseUrl += '&start=' + data.start;
	}

	if (data.count) {
		baseUrl += '&count=' + data.count;
	}

	if (data.scope) {
		baseUrl += '&Scope=' + data.scope;
	}

	if (data.sortDirection) {
		baseUrl += '&SortDirection=' + data.sortDirection;
	}

	if (data.sortMethod) {
		baseUrl += '&SortMethod=' + data.sortMethod;
	}

	if (data.text) {
		baseUrl += '&Text=' + data.text;
	}
	return baseUrl;
}

export default Cancel;

export function cancelRequests() {
	Cancel.cancel('cancel');
}
