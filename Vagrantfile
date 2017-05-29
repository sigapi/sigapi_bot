Vagrant.configure(2) do |config|

    config.vm.box = "google/gce"

    config.ssh.username = ENV["SSH_USERNAME"]
    config.ssh.private_key_path = ENV["SSH_PRIVATE_KEY_PATH"]

    config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'" # https://superuser.com/a/1182104

    config.vm.provision "shell", :path => "vagrant/install.sh"
    config.vm.provision "shell", :path => "vagrant/run.sh"

    config.vm.provider :google do |google|

        google.name = "bot"
        google.image = "ubuntu-1604-xenial-v20170327"
        google.machine_type = "n1-standard-1"
        google.zone = "us-east1-b"
        google.external_ip = "104.196.198.42"
        google.can_ip_forward = true
        google.tags = [
            "http-server"
        ]

    end

end
