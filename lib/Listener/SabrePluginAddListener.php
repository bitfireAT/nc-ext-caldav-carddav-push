<?php

declare(strict_types=1);

/**
 * @copyright 2024 Jonathan Treffler <mail@jonathan-treffler.de>
 *
 * @author Jonathan Treffler <mail@jonathan-treffler.de>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\DavPush\Listener;

use OCA\DAV\Events\SabrePluginAddEvent;
use OCA\DavPush\Dav\ServiceDetectionPlugin;
use OCA\DavPush\Dav\SubscriptionManagementPlugin;

use OCP\EventDispatcher\Event;
use OCP\EventDispatcher\IEventListener;

use Psr\Container\ContainerInterface;

class SabrePluginAddListener implements IEventListener {
	public function __construct(private ContainerInterface $container) {}

	public function handle(Event $event): void {
		if ($event instanceof SabrePluginAddEvent) {
			$serviceDetectionPlugin = $this->container->get(ServiceDetectionPlugin::class);
			$subscriptionManagementPlugin = $this->container->get(SubscriptionManagementPlugin::class);

			$event->getServer()->addPlugin($serviceDetectionPlugin);
			$event->getServer()->addPlugin($subscriptionManagementPlugin);
		}
	}
}