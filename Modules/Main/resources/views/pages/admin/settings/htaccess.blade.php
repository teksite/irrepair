<x-main::admin-editor-layout :instance="$content" method="PATCH">
    @section('title' , __('edit :title',['title'=>__('htaccess')]))
    @section('header-description' , __("in this window you can edit the :title", ['title'=>__('htaccess')]))
    @section('formRoute',route('admin.settings.htaccess.update'))
    @section('main')
        <x-main::box>
            <x-main::input.label value="{{__('htaccess')}}" for="robot" class="mb-3"/>
            <x-main::input.textarea id="robot" name="content" class="w-full block text-gray-200 bg-zinc-900" rows="16" dir="ltr">
                {{$content}}
            </x-main::input.textarea>
        </x-main::box>
        <div>
            <span class="font-bold block mb-6">{{__('default htaccess content')}}</span>
            <div>
                <textarea readonly disabled class="w-full block p-3" rows="15" dir="ltr">
<IfModule mod_expires.c>
                        ExpiresActive On
                        ExpiresByType image/jpg "access plus 1 year"
                        ExpiresByType image/jpeg "access plus 1 year"
                        ExpiresByType image/gif "access plus 1 year"
                        ExpiresByType image/png "access plus 1 year"
                        ExpiresByType text/css "access plus 1 month"
                        ExpiresByType text/html "access plus 1 hour"
                        ExpiresByType application/pdf "access plus 1 month"
                        ExpiresByType text/x-javascript "access plus 1 month"
                        ExpiresByType application/x-shockwave-flash "access plus 1 month"
                        ExpiresByType image/x-icon "access plus 1 year"
                        ExpiresByType application/javascript "access plus 1 year"
                        ExpiresByType application/x-font-woff "access plus 1 year"
                        ExpiresByType application/x-font-ttf "access plus 1 year"
                        ExpiresByType application/x-font-opentype "access plus 1 year"
                        ExpiresByType application/vnd.ms-fontobject "access plus 1 year"
                        ExpiresByType image/svg+xml "access plus 1 year"
                        ExpiresByType font/woff2 "access plus 1 year"
                    </IfModule>

                    <IfModule mod_headers.c>
                        <FilesMatch "\.(ico|jpe?g|png|gif|swf)$">
                        Header set Cache-Control "max-age=31536000, public"
                        </FilesMatch>
                        <FilesMatch "\.(css)$">
                        Header set Cache-Control "max-age=2592000, public"
                        </FilesMatch>
                        <FilesMatch "\.(js)$">
                        Header set Cache-Control "max-age=2592000, private"
                        </FilesMatch>
                        <FilesMatch "\.(x?html?|php)$">
                        Header set Cache-Control "max-age=3600, private, must-revalidate"
                        </FilesMatch>
                    </IfModule>

                    <IfModule mod_deflate.c>
                        AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript application/json
                        <IfModule mod_setenvif.c>
                            <IfModule mod_headers.c>
                                SetEnvIfNoCase Request_URI \.(?:gif|jpe?g|png)$ no-gzip dont-vary
                            </IfModule>
                        </IfModule>
                    </IfModule>

                    <IfModule mod_headers.c>
                        Header unset ETag
                        Header set ETag ""
                    </IfModule>

                    <IfModule mod_rewrite.c>
                        RewriteEngine On

                        # Handle Authorization Header
                        RewriteCond %{HTTP:Authorization} .
                        RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

                        # Redirect Trailing Slashes If Not A Folder...
                        RewriteCond %{REQUEST_FILENAME} !-d
                        RewriteCond %{REQUEST_URI} (.+)/$
                        RewriteRule ^ %1 [L,R=301]

                        # Handle Front Controller...
                        RewriteCond %{REQUEST_FILENAME} !-d
                        RewriteCond %{REQUEST_FILENAME} !-f
                        RewriteRule ^ index.php [L]
                    </IfModule>
                </textarea>
            </div>
        </div>
    @endsection

</x-main::admin-editor-layout>
