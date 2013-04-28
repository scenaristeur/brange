"""Speaking HTTP server"""

__author__    = 'Thomas Schuessler <tulpe@atomar.de>'
__copyright__ = 'Copyright (c) 2009, Thomas Schuessler'
__license__   = 'Apache License, Version 2.0'


import android
import BaseHTTPServer
import urlparse

HOST_NAME   = ''
PORT_NUMBER = 9090

droid = android.Android()

PAGE_TEMPLATE = '''
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Talk through the droid</title>
<style type="text/css">
	* {
		font-family:arial;
		font-size:12pt;
	}
	body {
		background: #BBB;
	}
	#container {
		text-align:center;
		width:300px;
	}
	#say_what {
		background:yellow;
		border:3px solid #555;
		color:#555;
		width:250px;
		height:100px;
		padding:4px;
	}
	#talk_button {
		background:red;
		border:2px solid black;
	}
</style>
</head>
<body>
	<div id="container">
	<form method="get">
		<textarea id="say_what" name="say_what">%s</textarea><br />
		<input id="talk_button" type="submit" value="talk!" />
	</form>
	</div>
</body>
</html>
'''


class DroidHandler(BaseHTTPServer.BaseHTTPRequestHandler):
    
	def do_HEAD(s):
		s.send_response(200)
		s.send_header("Content-type", "text/html; charset=utf-8")
		s.end_headers()

	def do_GET(s):
		"""Respond to a GET request."""
		s.send_response(200)
		s.send_header("Content-type", "text/html; charset=utf-8")
		s.end_headers()
		
		url = urlparse.urlsplit(s.path)
		if url.path != '/':
			return
			
		query = url.query
		args = urlparse.parse_qsl(query)
		
		say_what = ''
		for arg in args:
			if arg[0] == 'say_what':
				say_what = arg[1].strip().replace('\r', '')
				
				droid.speak(say_what)
				notice = '%s says:\n\n%s' % (s.client_address[0], say_what)
				droid.makeToast(notice)
				print(notice)
				break

		html = PAGE_TEMPLATE % say_what
		s.wfile.write(html)

print 'web server running on port %s' % PORT_NUMBER

BaseHTTPServer.HTTPServer((HOST_NAME, PORT_NUMBER), DroidHandler).serve_forever()

