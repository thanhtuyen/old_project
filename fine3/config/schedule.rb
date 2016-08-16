# Use this file to easily define all of your cron jobs.
#
# It's helpful, but not entirely necessary to understand cron before proceeding.
# http://en.wikipedia.org/wiki/Cron

# Example:
#
# set :output, "/path/to/my/cron_log.log"
#
# every 2.hours do
#   command "/usr/bin/some_great_command"
#   runner "MyModel.some_method"
#   rake "some:great:rake:task"
# end
#
# every 4.days do
#   runner "AnotherModel.prune_old_records"
# end

# Learn more: http://github.com/javan/whenever
set :output, "application/logs/batch.log"

job_type :php, "cd :path && CI_ENV=:environment php :task :output"

# every '0 3 * * *' do
#   php 'public/index.php tools find_remember_jobs'
# end

# every '0 18 * * *' do
#   php " public/index.php tools create_remember_jobs"
# end

every '0 20 * * *' do
  php " app/index.php batch/batch make_3job_list"
end

every '30 17 * * *' do
  php " app/index.php batch/batch send_3job_mail"
end
php 

# every '0 20 * * *' do
#   php " public/index.php tools send_email_and_remember_jobs_to_today_register_user"
# end
