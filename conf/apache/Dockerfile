FROM httpd:alpine

# 1. Activer mod_rewrite (décommenter la ligne dans la httpd.conf officielle)
RUN sed -i 's|#LoadModule rewrite_module|LoadModule rewrite_module|' \
        /usr/local/apache2/conf/httpd.conf \
    # 2. Activer mod_proxy et mod_proxy_fcgi (pour PHP-FPM)
    && sed -i 's|#LoadModule proxy_module|LoadModule proxy_module|' \
        /usr/local/apache2/conf/httpd.conf \
    && sed -i 's|#LoadModule proxy_fcgi_module|LoadModule proxy_fcgi_module|' \
        /usr/local/apache2/conf/httpd.conf \
    # 3. Inclure notre fichier de config additionnel
    && echo "Include conf/extra/httpd-phpfpm.conf" \
        >> /usr/local/apache2/conf/httpd.conf

# 4. Copier uniquement notre surcouche
COPY httpd-phpfpm.conf /usr/local/apache2/conf/extra/httpd-phpfpm.conf

EXPOSE 80