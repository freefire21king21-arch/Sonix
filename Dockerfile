FROM php:8.2-apache

# تمكين إعادة كتابة المسارات
RUN a2enmod rewrite

# نسخ ملفات البوت إلى مجلد Apache
COPY . /var/www/html/

# تعيين الصلاحيات
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# تعيين الملف الرئيسي
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80
